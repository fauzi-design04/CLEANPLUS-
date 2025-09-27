<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Services 
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');

// Authentication
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes (untuk customer) - DIGABUNGKAN
Route::middleware(['auth'])->group(function () {
    // Order Routes
    Route::get('/orders/create/{id}', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{id}/confirm', [OrderController::class, 'confirm'])->name('orders.confirm');
    Route::post('/orders/{id}/confirm', [OrderController::class, 'confirmProcess'])->name('orders.confirm.process');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

// Admin Routes - DIPERBAIKI TANPA MENGHILANGKAN YANG SUDAH ADA
Route::prefix('admin')->name('admin.')->group(function () {
    // Route tanpa middleware dulu untuk testing (TETAP ADA)
    Route::get('/dashboard', function () {
        // Check manual untuk admin
        if (!auth()->check()) {
            return redirect('/login');
        }
        
        if (!auth()->user()->is_admin) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }
        
        // Panggil controller manual
        return app(AdminController::class)->dashboard();
    })->name('dashboard');
    
    Route::get('/services', function () {
        if (!auth()->check()) {
            return redirect('/login');
        }
        
        if (!auth()->user()->is_admin) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }
        
        return app(AdminController::class)->services();
    })->name('services');
    
    Route::get('/orders', function () {
        if (!auth()->check()) {
            return redirect('/login');
        }
        
        if (!auth()->user()->is_admin) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }
        
        return app(AdminController::class)->orders();
    })->name('orders');
    
    Route::get('/customers', function () {
        if (!auth()->check()) {
            return redirect('/login');
        }
        
        if (!auth()->user()->is_admin) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }
        
        return app(AdminController::class)->customers();
    })->name('customers');

    // TAMBAHKAN ROUTE ADMIN YANG BARU (CRUD OPERATIONS)
    Route::post('/services', function () {
        if (!auth()->check()) {
            return redirect('/login');
        }
        
        if (!auth()->user()->is_admin) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }
        
        return app(AdminController::class)->serviceStore(request());
    })->name('services.store');
    
    Route::put('/services/{id}', function ($id) {
        if (!auth()->check()) {
            return redirect('/login');
        }
        
        if (!auth()->user()->is_admin) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }
        
        return app(AdminController::class)->serviceUpdate(request(), $id);
    })->name('services.update');
    
    Route::delete('/services/{id}', function ($id) {
        if (!auth()->check()) {
            return redirect('/login');
        }
        
        if (!auth()->user()->is_admin) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }
        
        return app(AdminController::class)->serviceDestroy($id);
    })->name('services.destroy');
    
    // Order Management Routes
    Route::get('/orders/{id}', function ($id) {
        if (!auth()->check()) {
            return redirect('/login');
        }
        
        if (!auth()->user()->is_admin) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }
        
        return app(AdminController::class)->orderShow($id);
    })->name('orders.show');
    
    Route::put('/orders/{id}/status', function ($id) {
        if (!auth()->check()) {
            return redirect('/login');
        }
        
        if (!auth()->user()->is_admin) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }
        
        return app(AdminController::class)->orderUpdateStatus(request(), $id);
    })->name('orders.update-status');
    
    Route::delete('/orders/{id}', function ($id) {
        if (!auth()->check()) {
            return redirect('/login');
        }
        
        if (!auth()->user()->is_admin) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }
        
        return app(AdminController::class)->orderDestroy($id);
    })->name('orders.destroy');
    
    // Customer Management Routes
    Route::get('/customers/{id}', function ($id) {
        if (!auth()->check()) {
            return redirect('/login');
        }
        
        if (!auth()->user()->is_admin) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }
        
        return app(AdminController::class)->customerShow($id);
    })->name('customers.show');
    
    // Reports Route
    Route::get('/reports', function () {
        if (!auth()->check()) {
            return redirect('/login');
        }
        
        if (!auth()->user()->is_admin) {
            return redirect('/')->with('error', 'Akses ditolak.');
        }
        
        return app(AdminController::class)->reports();
    })->name('reports');
});

// Redirect to admin dashboard
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});