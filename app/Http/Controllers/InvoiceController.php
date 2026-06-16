<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Services\PdfService;
use App\Services\EmailService;
use App\Services\WhatsAppService;

class InvoiceController extends Controller
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with('customer')->latest()->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $nextNumber = $this->generateInvoiceNumber();
        return view('invoices.create', compact('customers', 'nextNumber'));
    }

    /**
     * Store a newly created resource in accordance with the specified storage requirements.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'po_number' => 'nullable|string|max:100',
            'is_taxable' => 'nullable|boolean',
            'invoice_date' => 'required|date',
            'due_date' => 'nullable|date',
            'status' => 'required|in:Unpaid,Partial,Paid',
            'items' => 'required|array|min:1',
            'items.*.item_code' => 'nullable|string|max:100',
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

            $isTaxable = $request->boolean('is_taxable');
            $tax = $isTaxable ? ($subtotal * 0.11) : 0;
            $total = $subtotal + $tax;

            $invoice = Invoice::create([
                'invoice_no' => $this->generateInvoiceNumber(),
                'po_number' => $request->po_number,
                'customer_id' => $request->customer_id,
                'is_taxable' => $isTaxable,
                'invoice_date' => $request->invoice_date,
                'due_date' => $request->due_date,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'status' => $request->status,
            ]);

            foreach ($request->items as $item) {
                $invoice->items()->create([
                    'item_code' => $item['item_code'] ?? null,
                    'description' => $item['description'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'total' => $item['qty'] * $item['price'],
                ]);
            }

            DB::commit();

            return redirect()->route('invoices.index')->with('success', 'Invoice berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal membuat invoice: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load(['customer', 'items']);
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $customers = Customer::all();
        $invoice->load('items');
        return view('invoices.edit', compact('invoice', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'po_number' => 'nullable|string|max:100',
            'is_taxable' => 'nullable|boolean',
            'invoice_date' => 'required|date',
            'due_date' => 'nullable|date',
            'status' => 'required|in:Unpaid,Partial,Paid',
            'items' => 'required|array|min:1',
            'items.*.item_code' => 'nullable|string|max:100',
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

            $isTaxable = $request->boolean('is_taxable');
            $tax = $isTaxable ? ($subtotal * 0.11) : 0;
            $total = $subtotal + $tax;

            $invoice->update([
                'customer_id' => $request->customer_id,
                'po_number' => $request->po_number,
                'is_taxable' => $isTaxable,
                'invoice_date' => $request->invoice_date,
                'due_date' => $request->due_date,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'status' => $request->status,
            ]);

            // Simple approach: delete existing items and recreate
            $invoice->items()->delete();
            foreach ($request->items as $item) {
                $invoice->items()->create([
                    'item_code' => $item['item_code'] ?? null,
                    'description' => $item['description'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'total' => $item['qty'] * $item['price'],
                ]);
            }

            DB::commit();

            return redirect()->route('invoices.show', $invoice)->with('success', 'Invoice berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui invoice: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        try {
            $invoice->delete();
            return redirect()->route('invoices.index')->with('success', 'Invoice berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus invoice: ' . $e->getMessage());
        }
    }

    private function generateInvoiceNumber()
    {
        $year = date('Y');
        $prefix = "INV/HNET/{$year}/";

        $lastInvoice = Invoice::where('invoice_no', 'like', $prefix . '%')
            ->orderBy('invoice_no', 'desc')
            ->first();

        if (!$lastInvoice) {
            return $prefix . '0001';
        }

        $lastNumber = intval(substr($lastInvoice->invoice_no, -4));
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

        return $prefix . $newNumber;
    }

    // Generate PDF view (same as quotation)
    public function generatePdf(Invoice $invoice)
    {
        $invoice->load(['customer', 'items']);
        return view('invoices.pdf-preview', compact('invoice'));
    }

    // Download PDF
    public function downloadPdf(Invoice $invoice)
    {
        $invoice->load(['customer', 'items']);
        $safeFilename = str_replace(['/', '\\'], '-', $invoice->invoice_no . ' ' . $invoice->customer->company_name . '.pdf');
        return $this->pdfService->download(
            'pdf.invoice',
            ['invoice' => $invoice],
            $safeFilename
        );
    }

    // Stream PDF in browser
    public function printPdf(Invoice $invoice)
    {
        $invoice->load(['customer', 'items']);
        $safeFilename = str_replace(['/', '\\'], '-', $invoice->invoice_no . ' ' . $invoice->customer->company_name . '.pdf');
        return $this->pdfService->stream(
            'pdf.invoice',
            ['invoice' => $invoice],
            $safeFilename
        );
    }

    // Send email with PDF attachment (mirroring quotation)
    public function sendEmail(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'to' => 'required|email',
            'cc' => 'nullable|email',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        try {
            $invoice->load(['customer', 'items']);
            $filePath = $this->pdfService->save(
                'pdf.invoice',
                ['invoice' => $invoice],
                'invoice_' . $invoice->invoice_no . '.pdf'
            );
            $this->emailService->sendWithAttachment(
                $validated['to'],
                $validated['subject'],
                nl2br($validated['body']),
                $filePath,
                'Invoice-' . $invoice->invoice_no . '.pdf'
            );
            return back()->with('success', 'Email berhasil dikirim ke ' . $validated['to']);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }

    // Send WhatsApp with PDF link (mirroring quotation)
    public function sendWhatsApp(Invoice $invoice)
    {
        try {
            $invoice->load(['customer', 'items']);
            $filePath = $this->pdfService->save(
                'pdf.invoice',
                ['invoice' => $invoice],
                'invoice_' . $invoice->invoice_no . '.pdf'
            );
            $fileUrl = asset('storage/' . $filePath);
            $message = 'Kepada Yth. ' . $invoice->customer->pic_name . ', berikut invoice dari kami: ' . $fileUrl;
            $this->whatsappService->sendWithFile(
                $invoice->customer->phone,
                $message,
                $fileUrl
            );
            return back()->with('success', 'WhatsApp berhasil dikirim ke ' . $invoice->customer->phone);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim WhatsApp: ' . $e->getMessage());
        }
    }
}