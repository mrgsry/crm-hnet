<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfService
{
    /**
     * Generate PDF from view and return the instance
     */
    public function generate($view, $data, $fileName = null)
    {
        $pdf = Pdf::loadView($view, $data);
        return $pdf;
    }

    /**
     * Generate and save PDF to storage
     */
    public function save($view, $data, $path)
    {
        $pdf = $this->generate($view, $data);
        Storage::disk('public')->put($path, $pdf->output());
        return $path;
    }

    /**
     * Generate and stream PDF to browser
     */
    public function stream($view, $data, $fileName)
    {
        return $this->generate($view, $data)->stream($fileName);
    }

    /**
     * Generate and download PDF
     */
    public function download($view, $data, $fileName)
    {
        return $this->generate($view, $data)->download($fileName);
    }

    /**
     * Generate Berita Acara PDF
     */
    public function generateBeritaAcaraPdf($beritaAcara)
    {
        $data = [
            'beritaAcara' => $beritaAcara,
        ];
        
        // Clean filename from slashes
        $safeNumber = str_replace(['/', '\\'], '-', $beritaAcara->nomor);
        $fileName = 'berita-acara-' . $safeNumber . '.pdf';
        
        return $this->stream('pdf.berita-acara', $data, $fileName);
    }
}