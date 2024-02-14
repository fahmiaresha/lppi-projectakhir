<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_item;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Hitung jumlah omset
        $totalOmset = Order::sum('order_total');

        // Hitung jumlah admin
        $totalAdmin = User::count();

        // Hitung jumlah kategori produk
        $totalCategories = Categorie::count();

        // Hitung jumlah produk
        $totalProducts = Product::count();

        // Hitung jumlah orderan baru
        $newOrders = Order::where('order_status', 'pending')->count();

        // Hitung jumlah order yang sedang diproses
        $processingOrders = Order::where('order_status', 'on_progress')->count();

        // Hitung jumlah orderan yang sudah dikirim
        $shippedOrders = Order::where('order_status', 'paid')->count();

        // Hitung jumlah orderan yang sudah selesai
        $completedOrders = Order::where('order_status', 'delivered')->count();

        // Hitung jumlah penjualan per hari, bulan, dan tahun
        $dailySales = Order::whereDate('order_date', today())->sum('order_total');
        $monthlySales = Order::whereMonth('order_date', now()->month)->sum('order_total');
        $yearlySales = Order::whereYear('order_date', now()->year)->sum('order_total');

        // Hitung jumlah produk terjual per hari, bulan, dan tahun
        $dailySoldProducts = Order_item::whereDate('order_date', today())->sum('qty');
        $monthlySoldProducts = Order_item::whereMonth('order_date', now()->month)->sum('qty');
        $yearlySoldProducts = Order_item::whereYear('order_date', now()->year)->sum('qty');

        return view('home', compact('totalOmset', 'totalAdmin', 'totalCategories', 'totalProducts', 'newOrders', 'processingOrders', 'shippedOrders', 'completedOrders', 'dailySales', 'monthlySales', 'yearlySales', 'dailySoldProducts', 'monthlySoldProducts', 'yearlySoldProducts'));
    }
}
