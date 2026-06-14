<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\BeritaAcaraController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public Landing Page
Route::get('/', function () {
    $pages = \App\Models\CmsPage::all()->keyBy('slug');
    return view('landing', compact('pages'));
})->name('landing');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Customers
    Route::resource('customers', CustomerController::class);

    // Quotations
    Route::resource('quotations', QuotationController::class);
    Route::get('quotations/{quotation}/pdf', [QuotationController::class, 'generatePdf'])->name('quotations.pdf');
    Route::get('quotations/{quotation}/pdf/download', [QuotationController::class, 'downloadPdf'])->name('quotations.pdf.download');
    Route::get('quotations/{quotation}/pdf/print', [QuotationController::class, 'printPdf'])->name('quotations.pdf.print');
    Route::post('quotations/{quotation}/email', [QuotationController::class, 'sendEmail'])->name('quotations.email');
    Route::post('quotations/{quotation}/wa', [QuotationController::class, 'sendWhatsApp'])->name('quotations.wa');

    // Invoices
    Route::resource('invoices', InvoiceController::class);
    Route::post('invoices/{invoice}/pdf', [InvoiceController::class, 'generatePdf'])->name('invoices.pdf');
    Route::post('invoices/{invoice}/email', [InvoiceController::class, 'sendEmail'])->name('invoices.email');
    Route::post('invoices/{invoice}/wa', [InvoiceController::class, 'sendWhatsApp'])->name('invoices.wa');

    // Berita Acara
    Route::resource('berita-acara', BeritaAcaraController::class);
    Route::get('berita-acara/{beritaAcara}/pdf', [BeritaAcaraController::class, 'generatePdf'])->name('berita-acara.pdf');
    Route::post('berita-acara/{beritaAcara}/email', [BeritaAcaraController::class, 'sendEmail'])->name('berita-acara.send-email');

    // CMS
    Route::get('cms', [CmsController::class, 'index'])->name('cms.index');
    Route::get('cms/{slug}', [CmsController::class, 'edit'])->name('cms.edit');
    Route::put('cms/{slug}', [CmsController::class, 'update'])->name('cms.update');

    // Reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/revenue', [ReportController::class, 'revenue'])->name('reports.revenue');
    Route::get('reports/quotation-conversion', [ReportController::class, 'quotationConversion'])->name('reports.quotation-conversion');
    Route::get('reports/outstanding-invoice', [ReportController::class, 'outstandingInvoice'])->name('reports.outstanding-invoice');
    Route::get('reports/customer-growth', [ReportController::class, 'customerGrowth'])->name('reports.customer-growth');
});

require __DIR__.'/auth.php';