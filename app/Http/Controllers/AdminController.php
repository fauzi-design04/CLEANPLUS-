<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'total_customers' => User::where('is_admin', false)->count(),
            'total_services' => Service::count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total_price'),
            'today_orders' => Order::whereDate('created_at', today())->count(),
            'weekly_revenue' => Order::where('status', 'completed')
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->sum('total_price')
        ];

        $recent_orders = Order::with(['user', 'service'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_orders'));
    }

    public function services()
    {
        $services = Service::orderBy('created_at', 'desc')->get();
        return view('admin.services', compact('services'));
    }

    public function serviceStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_hour' => 'required|numeric|min:0',
            'duration_hours' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ]);

        Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'price_per_hour' => $request->price_per_hour,
            'duration_hours' => $request->duration_hours,
            'is_active' => $request->is_active ?? true
        ]);

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function serviceUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_hour' => 'required|numeric|min:0',
            'duration_hours' => 'required|integer|min:1',
            'is_active' => 'boolean'
        ]);

        $service = Service::findOrFail($id);
        $service->update([
            'name' => $request->name,
            'description' => $request->description,
            'price_per_hour' => $request->price_per_hour,
            'duration_hours' => $request->duration_hours,
            'is_active' => $request->is_active ?? true
        ]);

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function serviceDestroy($id)
    {
        $service = Service::findOrFail($id);
        
        // Cek apakah ada pesanan yang menggunakan layanan ini
        $orderCount = Order::where('service_id', $id)->count();
        if ($orderCount > 0) {
            return redirect()->route('admin.services')->with('error', 'Tidak dapat menghapus layanan yang sudah digunakan dalam pesanan!');
        }

        $service->delete();
        return redirect()->route('admin.services')->with('success', 'Layanan berhasil dihapus!');
    }

    public function orders()
    {
        $orders = Order::with(['user', 'service'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders', compact('orders'));
    }

    public function orderUpdateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
            'confirmed_at' => $request->status === 'confirmed' ? now() : $order->confirmed_at
        ]);

        return redirect()->route('admin.orders')->with('success', 'Status pesanan berhasil diperbarui!');
    }

    public function orderShow($id)
    {
        $order = Order::with(['user', 'service'])->findOrFail($id);
        return view('admin.order-show', compact('order'));
    }

    public function orderDestroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders')->with('success', 'Pesanan berhasil dihapus!');
    }

    public function customers()
    {
        $customers = User::where('is_admin', false)
            ->withCount(['orders'])
            ->withSum('orders', 'total_price')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.customers', compact('customers'));
    }

    // public function customerShow($id)
    // {
    //     $customer = User::with(['orders.service'])
    //         ->where('is_admin', false)
    //         ->findOrFail($id);

    //     $orderStats = [
    //         'total_orders' => $customer->orders->count(),
    //         'total_spent' => $customer->orders->where('status', 'completed')->sum('total_price'),
    //         'pending_orders' => $customer->orders->where('status', 'pending')->count(),
    //         'completed_orders' => $customer->orders->where('status', 'completed')->count()
    //     ];

    //     return view('admin.customer-show', compact('customer', 'orderStats'));
    // }

    public function reports()
    {
        // Data untuk chart
        $monthlyRevenue = Order::where('status', 'completed')
            ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_price) as revenue'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->limit(6)
            ->get();

        $popularServices = Service::withCount(['orders'])
            ->orderBy('orders_count', 'desc')
            ->limit(5)
            ->get();

        return view('admin.reports', compact('monthlyRevenue', 'popularServices'));
    }

    public function customerShow($id)
{
    $customer = User::with(['orders.service'])
        ->where('is_admin', false)
        ->findOrFail($id);

    $orderStats = [
        'total_orders' => $customer->orders->count(),
        'total_spent' => $customer->orders->where('status', 'completed')->sum('total_price'),
        'pending_orders' => $customer->orders->where('status', 'pending')->count(),
        'completed_orders' => $customer->orders->where('status', 'completed')->count()
    ];

    return view('admin.customer-show', compact('customer', 'orderStats'));
}
}