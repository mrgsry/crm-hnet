<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Quotation;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function revenue()
    {
        $revenueData = Invoice::select(
            DB::raw('DATE_FORMAT(invoice_date, "%Y-%m") as month'),
            DB::raw('SUM(total) as total_revenue')
        )
        ->where('status', 'Paid')
        ->groupBy('month')
        ->orderBy('month', 'desc')
        ->get();

        return view('reports.revenue', compact('revenueData'));
    }

    public function quotationConversion()
    {
        $totalQuotations = Quotation::count();
        $approvedQuotations = Quotation::where('status', 'Approved')->count();
        
        $conversionRate = $totalQuotations > 0 ? ($approvedQuotations / $totalQuotations) * 100 : 0;

        $statusData = Quotation::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        return view('reports.quotation-conversion', compact('totalQuotations', 'approvedQuotations', 'conversionRate', 'statusData'));
    }

    public function outstandingInvoice()
    {
        $outstandingInvoices = Invoice::with('customer')
            ->whereIn('status', ['Unpaid', 'Partial'])
            ->orderBy('due_date', 'asc')
            ->get();

        $totalOutstanding = $outstandingInvoices->sum('total');

        return view('reports.outstanding-invoice', compact('outstandingInvoices', 'totalOutstanding'));
    }

    public function customerGrowth()
    {
        $growthData = Customer::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('count(*) as count')
        )
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

        return view('reports.customer-growth', compact('growthData'));
    }
}