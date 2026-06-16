<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\BeritaAcaraAttachment;
use App\Models\Customer;
use App\Models\EmailLog;
use App\Mail\BeritaAcaraMail;
use App\Services\PdfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BeritaAcaraController extends Controller
{
    protected $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function index()
    {
        $beritaAcaras = BeritaAcara::with('customer')
            ->orderBy('tanggal', 'desc')
            ->paginate(10);
        return view('berita-acara.index', compact('beritaAcaras'));
    }

    public function create()
    {
        $customers = Customer::all();
        $nextNumber = $this->generateNumber();
        return view('berita-acara.create', compact('customers', 'nextNumber'));
    }

    public function store(Request $request)
    {
        // Log untuk debugging
        \Illuminate\Support\Facades\Log::info('Berita Acara Store Request', [
            'has_files' => $request->hasFile('attachments'),
            'all_files' => $request->allFiles(),
            'all_input' => $request->except(['attachments'])
        ]);

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'tanggal' => 'required|date',
            'jenis' => 'required|in:Serah Terima,Instalasi,Maintenance,Pekerjaan Selesai',
            'isi' => 'required',
            'attachments' => 'nullable|array',
            'attachments.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Increased to 10MB
            'captions' => 'nullable|array',
            'captions.*' => 'nullable|string|max:255',
        ]);

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();
            
            $validated['nomor'] = $this->generateNumber();
            $beritaAcara = BeritaAcara::create($validated);

            // Handle attachments
            if ($request->hasFile('attachments')) {
                $attachments = $request->file('attachments');
                $captions = $request->input('captions', []);
                
                \Illuminate\Support\Facades\Log::info('Processing attachments', [
                    'count' => count($attachments),
                    'captions_count' => count($captions)
                ]);
                
                $validFileIndex = 0;
                foreach ($attachments as $index => $file) {
                    // Skip if file is null or empty
                    if ($file === null || !$file->isValid()) {
                        \Illuminate\Support\Facades\Log::warning('Skipping invalid file at index: ' . $index);
                        continue;
                    }
                    
                    $path = $file->store('berita-acara-attachments', 'public');
                    $caption = $captions[$index] ?? null;
                    
                    \Illuminate\Support\Facades\Log::info('Saving attachment', [
                        'index' => $index,
                        'path' => $path,
                        'caption' => $caption,
                        'original_name' => $file->getClientOriginalName()
                    ]);
                    
                    BeritaAcaraAttachment::create([
                        'berita_acara_id' => $beritaAcara->id,
                        'file_path' => $path,
                        'caption' => $caption,
                        'order' => $validFileIndex,
                    ]);
                    
                    $validFileIndex++;
                }
                
                \Illuminate\Support\Facades\Log::info('Total attachments saved: ' . $validFileIndex);
            } else {
                \Illuminate\Support\Facades\Log::info('No attachments in request');
            }

            \Illuminate\Support\Facades\DB::commit();
            return redirect()->route('berita-acara.show', $beritaAcara)->with('success', 'Berita Acara berhasil dibuat.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            \Illuminate\Support\Facades\Log::error('Failed to save Berita Acara', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withInput()->with('error', 'Gagal menyimpan Berita Acara: ' . $e->getMessage());
        }
    }

    public function show(BeritaAcara $beritaAcara)
    {
        $beritaAcara->load(['customer', 'attachments']);
        return view('berita-acara.show', compact('beritaAcara'));
    }

    public function edit(BeritaAcara $beritaAcara)
    {
        $beritaAcara->load('attachments');
        $customers = Customer::all();
        return view('berita-acara.edit', compact('beritaAcara', 'customers'));
    }

    public function update(Request $request, BeritaAcara $beritaAcara)
    {
        // Log untuk debugging
        \Illuminate\Support\Facades\Log::info('Berita Acara Update Request', [
            'berita_acara_id' => $beritaAcara->id,
            'has_files' => $request->hasFile('attachments'),
            'all_files' => $request->allFiles(),
            'existing_attachments' => $request->input('existing_attachments'),
            'delete_attachments' => $request->input('delete_attachments')
        ]);

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'tanggal' => 'required|date',
            'jenis' => 'required|in:Serah Terima,Instalasi,Maintenance,Pekerjaan Selesai',
            'isi' => 'required',
            'attachments' => 'nullable|array',
            'attachments.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Increased to 10MB
            'captions' => 'nullable|array',
            'captions.*' => 'nullable|string|max:255',
            'delete_attachments' => 'nullable|array',
            'delete_attachments.*' => 'exists:berita_acara_attachments,id',
            'existing_attachments' => 'nullable|array',
            'existing_attachments.*.id' => 'required|exists:berita_acara_attachments,id',
            'existing_attachments.*.caption' => 'nullable|string|max:255',
        ]);

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            $beritaAcara->update($validated);

            $attachmentsToDelete = $request->input('delete_attachments', []);
            $existingAttachments = $request->input('existing_attachments', []);

            // Process existing attachments: update captions or delete if marked
            foreach ($existingAttachments as $attachmentData) {
                $attachmentId = $attachmentData['id'];
                $caption = $attachmentData['caption'] ?? null;

                if (in_array($attachmentId, $attachmentsToDelete)) {
                    // Delete the attachment
                    $attachment = BeritaAcaraAttachment::find($attachmentId);
                    if ($attachment && $attachment->berita_acara_id == $beritaAcara->id) {
                        Storage::disk('public')->delete($attachment->file_path);
                        $attachment->delete();
                        \Illuminate\Support\Facades\Log::info('Deleted attachment: ' . $attachmentId);
                    }
                } else {
                    // Update caption for existing attachment
                    $attachment = BeritaAcaraAttachment::find($attachmentId);
                    if ($attachment && $attachment->berita_acara_id == $beritaAcara->id) {
                        $attachment->update(['caption' => $caption]);
                        \Illuminate\Support\Facades\Log::info('Updated caption for attachment: ' . $attachmentId);
                    }
                }
            }

            // Handle new attachments
            if ($request->hasFile('attachments')) {
                $attachments = $request->file('attachments');
                $captions = $request->input('captions', []);
                
                \Illuminate\Support\Facades\Log::info('Processing new attachments', [
                    'count' => count($attachments),
                    'captions_count' => count($captions)
                ]);
                
                $currentMaxOrder = $beritaAcara->attachments()->max('order') ?? -1;
                $validFileIndex = 0;
                
                foreach ($attachments as $index => $file) {
                    // Skip if file is null or empty
                    if ($file === null || !$file->isValid()) {
                        \Illuminate\Support\Facades\Log::warning('Skipping invalid file at index: ' . $index);
                        continue;
                    }
                    
                    $path = $file->store('berita-acara-attachments', 'public');
                    $caption = $captions[$index] ?? null;
                    
                    \Illuminate\Support\Facades\Log::info('Saving new attachment', [
                        'index' => $index,
                        'path' => $path,
                        'caption' => $caption,
                        'original_name' => $file->getClientOriginalName()
                    ]);
                    
                    BeritaAcaraAttachment::create([
                        'berita_acara_id' => $beritaAcara->id,
                        'file_path' => $path,
                        'caption' => $caption,
                        'order' => $currentMaxOrder + $validFileIndex + 1,
                    ]);
                    
                    $validFileIndex++;
                }
                
                \Illuminate\Support\Facades\Log::info('Total new attachments saved: ' . $validFileIndex);
            } else {
                \Illuminate\Support\Facades\Log::info('No new attachments in request');
            }

            \Illuminate\Support\Facades\DB::commit();
            return redirect()->route('berita-acara.show', $beritaAcara)->with('success', 'Berita Acara berhasil diperbarui.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            \Illuminate\Support\Facades\Log::error('Failed to update Berita Acara', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withInput()->with('error', 'Gagal memperbarui Berita Acara: ' . $e->getMessage());
        }
    }

    public function destroy(BeritaAcara $beritaAcara)
    {
        $beritaAcara->delete();
        return redirect()->route('berita-acara.index')->with('success', 'Berita Acara berhasil dihapus.');
    }

    public function generatePdf(BeritaAcara $beritaAcara)
    {
        $beritaAcara->load('customer', 'attachments');
        return $this->pdfService->generateBeritaAcaraPdf($beritaAcara);
    }

    public function sendEmail(Request $request, BeritaAcara $beritaAcara)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            $filename = 'berita-acara-' . str_replace('/', '-', $beritaAcara->nomor) . '.pdf';
            
            // Send email using Mailable with Queue
            // Passing the model instead of PDF binary to avoid serialization issues
            Mail::to($validated['email'])->send(new BeritaAcaraMail(
                $validated['subject'],
                $validated['message'],
                $beritaAcara,
                $filename
            ));

            EmailLog::create([
                'recipient' => $validated['email'],
                'document' => $validated['subject'],
                'status' => 'Sent'
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Email berhasil dikirim ke ' . $validated['email']
                ], 200);
            }

            return redirect()->route('berita-acara.show', $beritaAcara)
                ->with('success', 'Email sedang dalam proses pengiriman ke ' . $validated['email']);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to send Berita Acara email', [
                'error' => $e->getMessage(),
                'berita_acara_id' => $beritaAcara->id
            ]);

            EmailLog::create([
                'recipient' => $request->input('email', 'Unknown'),
                'document' => $request->input('subject', 'Berita Acara Email'),
                'status' => 'Failed'
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengirim email: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('berita-acara.show', $beritaAcara)
                ->with('error', 'Gagal mengirim email: ' . $e->getMessage());
        }
    }

    private function generateNumber()
    {
        $year = date('Y');
        $lastDoc = BeritaAcara::whereYear('created_at', $year)->latest()->first();
        $number = 1;

        if ($lastDoc) {
            $parts = explode('/', $lastDoc->nomor);
            $lastNumber = (int) end($parts);
            $number = $lastNumber + 1;
        }

        return sprintf("BA/HNET/%s/%04d", $year, $number);
    }
}