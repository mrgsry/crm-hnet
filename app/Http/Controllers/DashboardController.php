<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Quotation;
use App\Models\Invoice;
use App\Models\EmailLog;
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
        $totalEmailSent = EmailLog::where('status', 'Sent')->count();

        $recentQuotations = Quotation::with('customer')
            ->latest()
            ->limit(5)
            ->get();

        $recentInvoices = Invoice::with('customer')
            ->latest()
            ->limit(5)
            ->get();

        $recentEmailLogs = EmailLog::latest()
            ->limit(10)
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

        // Chart Data: Landing Page Activity (Device Types)
        $landingActivity = [
            ['label' => 'Desktop', 'count' => 45],
            ['label' => 'Mobile', 'count' => 30],
            ['label' => 'Tablet', 'count' => 15],
            ['label' => 'Lainnya', 'count' => 10],
        ];

        // Chart Data: Landing Page Source
        $visitorSource = [
            ['label' => 'Direct', 'count' => 40],
            ['label' => 'Search', 'count' => 35],
            ['label' => 'Social', 'count' => 15],
            ['label' => 'Referral', 'count' => 10],
        ];

        return view('dashboard', compact(
            'totalCustomer',
            'totalQuotation',
            'totalInvoice',
            'totalRevenue',
            'outstandingInvoice',
            'totalEmailSent',
            'recentQuotations',
            'recentInvoices',
            'recentEmailLogs',
            'revenueData',
            'customerInvoices',
            'landingActivity',
            'visitorSource'
        ));
    }
}