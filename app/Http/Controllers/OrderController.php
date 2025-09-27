<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function create($id)
    {
        $service = Service::findOrFail($id);
        $kecamatanList = [
            'Danau Teluk', 'Jambi Selatan', 'Jambi Timur', 'Jelutung', 'Kota Baru',
            'Pasar Jambi', 'Pelayangan', 'Telanaipura', 'Alam Barajo', 'Paal Merah'
        ];
        
        return view('orders.create', compact('service', 'kecamatanList'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'service_id' => 'required|exists:services,id',
            'order_date' => 'required|date|after:today',
            'order_time' => 'required',
            'duration' => 'required|integer|min:1',
            'address' => 'required|string|max:500',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string|max:100',
            'phone' => 'required|string|max:15',
            'special_instructions' => 'nullable|string|max:1000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $service = Service::findOrFail($request->service_id);
            
            // Validasi durasi minimal
            if ($request->duration < $service->duration_hours) {
                return redirect()->back()
                    ->withErrors(['duration' => 'Durasi minimal untuk layanan ini adalah ' . $service->duration_hours . ' jam'])
                    ->withInput();
            }
            
            // Perhitungan harga
            $totalPrice = $service->price_per_hour * $request->duration;

            // Simpan pesanan
            $order = Order::create([
                'user_id' => Auth::id(),
                'service_id' => $request->service_id,
                'order_date' => $request->order_date,
                'order_time' => $request->order_time,
                'duration' => $request->duration,
                'total_price' => $totalPrice,
                'address' => $request->address,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'phone' => $request->phone,
                'special_instructions' => $request->special_instructions,
                'status' => 'pending'
            ]);

            // Redirect ke halaman pesanan dengan flash data untuk popup
            return redirect()->route('orders.index')
                ->with('order_success', true)
                ->with('success', 'Pesanan berhasil dibuat! Total: Rp ' . number_format($totalPrice, 0, ',', '.'))
                ->with('order_id', $order->id);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        $order = Order::with(['service', 'user'])->findOrFail($id);
        
        // Pastikan hanya pemilik order atau admin yang bisa melihat
        if ($order->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        return view('orders.show', compact('order'));
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                      ->with('service')
                      ->orderBy('created_at', 'desc')
                      ->paginate(10);
        
        return view('orders.index', compact('orders'));
    }
}