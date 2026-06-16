<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Services\PdfService;
use App\Services\EmailService;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{
    protected $pdfService;
    protected $emailService;
    protected $whatsappService;

    public function __construct(PdfService $pdfService, EmailService $emailService, WhatsAppService $whatsappService)
    {
        $this->pdfService = $pdfService;
        $this->emailService = $emailService;
        $this->whatsappService = $whatsappService;
    }

    public function index(Request $request)
    {
        $query = Quotation::with('customer');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('quotation_no', 'like', "%{$search}%")
                ->orWhereHas('customer', function ($q) use ($search) {
                    $q->where('company_name', 'like', "%{$search}%");
                });
        }

        if ($request->has('status')) {
            $query->where('status', $request->get('status'));
        }

        $quotations = $query->latest()->paginate(10);

        return view('quotations.index', compact('quotations'));
    }

    public function create(Request $request)
    {
        $customers = Customer::all();
        $selectedCustomerId = $request->get('customer_id');
        $quotationNo = Quotation::generateNumber();

        return view('quotations.create', compact('customers', 'selectedCustomerId', 'quotationNo'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'quotation_date' => 'required|date',
            'is_taxable' => 'nullable|boolean',
            'discount' => 'nullable|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $subtotal = 0;
            foreach ($request->items as $item) {
                $subtotal += $item['qty'] * $item['price'];
            }

            $discount = $request->discount ?? 0;
            $isTaxable = $request->boolean('is_taxable');
            $tax = $isTaxable ? (($subtotal - $discount) * 0.11) : 0; // PPN 11%
            $total = $subtotal - $discount + $tax;

            $quotation = Quotation::create([
                'quotation_no' => Quotation::generateNumber(),
                'customer_id' => $request->customer_id,
                'quotation_date' => $request->quotation_date,
                'is_taxable' => $isTaxable,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'tax' => $tax,
                'total' => $total,
                'status' => 'Draft',
            ]);

            foreach ($request->items as $item) {
                $quotation->items()->create([
                    'description' => $item['description'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'total' => $item['qty'] * $item['price'],
                ]);
            }

            DB::commit();

            return redirect()->route('quotations.index')
                ->with('success', 'Quotation berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Quotation $quotation)
    {
        $quotation->load(['customer', 'items']);
        return view('quotations.show', compact('quotation'));
    }

    public function edit(Quotation $quotation)
    {
        $quotation->load(['customer', 'items']);
        $customers = Customer::all();
        return view('quotations.edit', compact('quotation', 'customers'));
    }

    public function update(Request $request, Quotation $quotation)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'quotation_date' => 'required|date',
            'is_taxable' => 'nullable|boolean',
            'discount' => 'nullable|numeric|min:0',
            'status' => 'required|in:Draft,Sent,Approved,Rejected',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $subtotal = 0;
            foreach ($request->items as $item) {
                $subtotal += $item['qty'] * $item['price'];
            }

            $discount = $request->discount ?? 0;
            $isTaxable = $request->boolean('is_taxable');
            $tax = $isTaxable ? (($subtotal - $discount) * 0.11) : 0;
            $total = $subtotal - $discount + $tax;

            $quotation->update([
                'customer_id' => $request->customer_id,
                'quotation_date' => $request->quotation_date,
                'is_taxable' => $isTaxable,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'tax' => $tax,
                'total' => $total,
                'status' => $request->status,
            ]);

            $quotation->items()->delete();
            foreach ($request->items as $item) {
                $quotation->items()->create([
                    'description' => $item['description'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'total' => $item['qty'] * $item['price'],
                ]);
            }

            DB::commit();

            return redirect()->route('quotations.index')
                ->with('success', 'Quotation berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Quotation $quotation)
    {
        $quotation->items()->delete();
        $quotation->delete();

        return redirect()->route('quotations.index')
            ->with('success', 'Quotation berhasil dihapus.');
    }

     public function generatePdf(Quotation $quotation)
     {
         $quotation->load(['customer', 'items']);
         return view('quotations.pdf-preview', compact('quotation'));
     }

     public function downloadPdf(Quotation $quotation)
     {
         $quotation->load(['customer', 'items']);
         $safeFilename = str_replace(['/', '\\'], '-', $quotation->quotation_no . ' ' . $quotation->customer->company_name . '.pdf');
         return $this->pdfService->download(
             'pdf.quotation',
             ['quotation' => $quotation],
             $safeFilename
         );
     }

     public function printPdf(Quotation $quotation)
     {
         $quotation->load(['customer', 'items']);
         $safeFilename = str_replace(['/', '\\'], '-', $quotation->quotation_no . ' ' . $quotation->customer->company_name . '.pdf');
         return $this->pdfService->stream(
             'pdf.quotation',
             ['quotation' => $quotation],
             $safeFilename
         );
     }

     public function sendEmail(Request $request, Quotation $quotation)
     {
         $validated = $request->validate([
             'to' => 'required|email',
             'cc' => 'nullable|email',
             'subject' => 'required|string|max:255',
             'body' => 'required|string',
         ]);

         try {
             $quotation->load(['customer', 'items']);
             $filePath = $this->pdfService->save(
                 'pdf.quotation',
                 ['quotation' => $quotation],
                 'quotation_' . $quotation->quotation_no . '.pdf'
             );
             $this->emailService->sendWithAttachment(
                 $validated['to'],
                 $validated['subject'],
                 nl2br($validated['body']),
                 $filePath,
                 'Quotation-' . $quotation->quotation_no . '.pdf'
             );
             return back()->with('success', 'Email berhasil dikirim ke ' . $validated['to']);
         } catch (\Exception $e) {
             return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
         }
     }

     public function sendWhatsApp(Quotation $quotation)
     {
         try {
             $quotation->load(['customer', 'items']);
             $filePath = $this->pdfService->save(
                 'pdf.quotation',
                 ['quotation' => $quotation],
                 'quotation_' . $quotation->quotation_no . '.pdf'
             );
             $fileUrl = asset('storage/' . $filePath);
             $message = 'Kepada Yth. ' . $quotation->customer->pic_name . ', berikut penawaran harga dari kami: ' . $fileUrl;
             $this->whatsappService->sendWithFile(
                 $quotation->customer->phone,
                 $message,
                 $fileUrl
             );
             return back()->with('success', 'WhatsApp berhasil dikirim ke ' . $quotation->customer->phone);
         } catch (\Exception $e) {
             return back()->with('error', 'Gagal mengirim WhatsApp: ' . $e->getMessage());
         }
     }
}