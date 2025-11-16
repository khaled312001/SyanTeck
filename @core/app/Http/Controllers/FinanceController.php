<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FinanceController extends Controller
{
    /**
     * لوحة تحكم المالية
     */
    public function dashboard()
    {
        $stats = [
            'total_revenue' => Order::where('payment_status', 'complete')->sum('total'),
            'pending_payments' => Order::where('payment_status', 'pending')->sum('total'),
            'total_orders' => Order::count(),
            'completed_orders' => Order::where('status', 2)->count(),
            'today_revenue' => Order::whereDate('created_at', Carbon::today())
                ->where('payment_status', 'complete')
                ->sum('total'),
            'this_month_revenue' => Order::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->where('payment_status', 'complete')
                ->sum('total'),
        ];
        
        $recentInvoices = Order::with(['service', 'technician'])
            ->where('payment_status', 'complete')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('finance.dashboard', compact('stats', 'recentInvoices'));
    }

    /**
     * عرض الفواتير
     */
    public function invoices(Request $request)
    {
        $query = Order::with(['service', 'technician'])
            ->where('status', '>=', 1); // Active, Completed, Delivered
        
        // فلترة حسب حالة الدفع
        if ($request->has('payment_status') && $request->payment_status !== '') {
            $query->where('payment_status', $request->payment_status);
        }
        
        // فلترة حسب التاريخ
        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $invoices = $query->orderBy('created_at', 'desc')->paginate(20);
        
        $stats = [
            'total' => $invoices->sum('total'),
            'paid' => Order::where('payment_status', 'complete')->sum('total'),
            'pending' => Order::where('payment_status', 'pending')->sum('total'),
            'this_month' => Order::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('total'),
        ];
        
        return view('finance.invoices.index', compact('invoices', 'stats'));
    }

    /**
     * تحديث حالة الدفع
     */
    public function updatePaymentStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'payment_status' => 'required|in:pending,complete,failed,refunded',
        ]);
        
        $order->payment_status = $request->payment_status;
        $order->save();
        
        // TODO: إرسال إشعار للعميل
        
        return redirect()->back()->with('success', __('Payment status updated successfully'));
    }

    /**
     * التقارير المالية
     */
    public function reports(Request $request)
    {
        $dateFrom = $request->date_from ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $dateTo = $request->date_to ?? Carbon::now()->format('Y-m-d');
        
        $orders = Order::whereBetween('created_at', [$dateFrom, $dateTo])
            ->where('payment_status', 'complete')
            ->get();
        
        $reports = [
            'total_revenue' => $orders->sum('total'),
            'total_orders' => $orders->count(),
            'average_order_value' => $orders->count() > 0 ? $orders->sum('total') / $orders->count() : 0,
            'by_status' => $orders->groupBy('status')->map->count(),
            'by_payment_method' => $orders->groupBy('payment_gateway')->map->sum('total'),
            'daily_revenue' => $orders->groupBy(function($order) {
                return $order->created_at->format('Y-m-d');
            })->map->sum('total'),
        ];
        
        return view('finance.reports', compact('reports', 'dateFrom', 'dateTo'));
    }

    /**
     * الإحصائيات المالية
     */
    public function statistics()
    {
        $stats = [
            'today' => Order::whereDate('created_at', Carbon::today())
                ->where('payment_status', 'complete')
                ->sum('total'),
            'this_week' => Order::whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])->where('payment_status', 'complete')->sum('total'),
            'this_month' => Order::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->where('payment_status', 'complete')
                ->sum('total'),
            'this_year' => Order::whereYear('created_at', Carbon::now()->year)
                ->where('payment_status', 'complete')
                ->sum('total'),
            'total_revenue' => Order::where('payment_status', 'complete')->sum('total'),
            'pending_payments' => Order::where('payment_status', 'pending')->sum('total'),
        ];
        
        return view('finance.statistics', compact('stats'));
    }

    /**
     * عرض الملف الشخصي
     */
    public function profile()
    {
        $user = Auth::user();
        
        // سجل العمليات - الفواتير التي عالجها
        $activities = Order::where('payment_status', 'complete')
            ->with(['service', 'technician'])
            ->orderBy('updated_at', 'desc')
            ->limit(20)
            ->get();
        
        return view('finance.profile', compact('user', 'activities'));
    }

    /**
     * تحديث الملف الشخصي
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'nullable|string',
            'about' => 'nullable|string',
        ]);
        
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->about = $request->about;
        $user->save();
        
        return redirect()->back()->with('success', __('Profile updated successfully'));
    }
}

