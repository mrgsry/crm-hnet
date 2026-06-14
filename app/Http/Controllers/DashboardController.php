<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Quotation;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalCustomer = Customer::count();
        $totalQuotation = Quotation::count();
        $totalInvoice = Invoice::count();
        $totalRevenue = Invoice::where('status', 'Paid')->sum('total');
        $outstandingInvoice = Invoice::where('status', '!=', 'Paid')->sum('total');

        $recentQuotations = Quotation::with('customer')
            ->latest()
            ->limit(5)
            ->get();

        $recentInvoices = Invoice::with('customer')
            ->latest()
            ->limit(5)
            ->get();

        // Chart Data: Monthly Revenue (Current Year)
        $monthlyRevenue = Invoice::where('status', 'Paid')
            ->whereYear('created_at', Carbon::now()->year)
            ->select(
                DB::raw('SUM(total) as total'),
                DB::raw('MONTH(created_at) as month')
            )
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get()
            ->pluck('total', 'month')
            ->toArray();
        
        $revenueData = [];
        for ($i = 1; $i <= 12; $i++) {
            $revenueData[] = $monthlyRevenue[$i] ?? 0;
        }

        // Chart Data: Invoice Count per Customer
        $customerInvoices = Invoice::select('customer_id', DB::raw('count(*) as count'))
            ->with('customer')
            ->groupBy('customer_id')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalCustomer',
            'totalQuotation',
            'totalInvoice',
            'totalRevenue',
            'outstandingInvoice',
            'recentQuotations',
            'recentInvoices',
            'revenueData',
            'customerInvoices'
        ));
    }
}