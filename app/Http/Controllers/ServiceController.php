<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->get();
        return view('services.index', compact('services'));
    }

    public function show($id)
    {
        $service = Service::where('is_active', true)->findOrFail($id);
        $relatedServices = Service::where('is_active', true)
                                ->where('id', '!=', $id)
                                ->inRandomOrder()
                                ->limit(3)
                                ->get();
        
        return view('services.show', compact('service', 'relatedServices'));
    }
}