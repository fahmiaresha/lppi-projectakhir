<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_item;
use Carbon\Carbon;


class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct() {
        $this->middleware('auth');
        
    }
    public function index(Request $request)
    {
        $product = Product::all();
        $categories = Categorie::all();
        $user = User::all();
        $order_item = Order_item::all();
        $daterangepicker = $request->input('daterangepicker');
        $dates = explode(' - ', $daterangepicker);

        if (count($dates) == 2) {
            $startDate = Carbon::createFromFormat('d-m-Y', $dates[0])->startOfDay()->format('Y-m-d');
            $endDate = Carbon::createFromFormat('d-m-Y', $dates[1])->endOfDay()->format('Y-m-d');
            $order = Order::whereBetween('order_date', [$startDate, $endDate])->get();
        } else {

            $order = Order::all();
            $startDate = null;
            $endDate = null;
        }

        return view('laporan', compact('product', 'categories', 'user', 'order', 'order_item', 'startDate', 'endDate'));
    }


    public function filter(Request $request)
    {
        $product = Product::all();
        $categories = Categorie::all();
        $user = User::all();
        $order_item = Order_item::all();
        $daterangepicker = $request->input('daterangepicker');
        $dates = explode(' - ', $daterangepicker);
        if (count($dates) == 2) {
            $startDate = Carbon::createFromFormat('d-m-Y', $dates[0])->startOfDay()->format('Y-m-d');
            $endDate = Carbon::createFromFormat('d-m-Y', $dates[1])->endOfDay()->format('Y-m-d');
            $order = Order::whereBetween('order_date', [$startDate, $endDate])->get();
        } else {
            $order = Order::all();
            $startDate = null;
            $endDate = null;
        }

        return view('laporan', compact('product', 'categories', 'user', 'order', 'order_item', 'startDate', 'endDate'));
    }



    // public function index()
    // {
    //     $product = Product::all();
    //     $categories = Categorie::all();
    //     $user = User::all();
    //     $order_item = Order_item::all();

    //     $startDate = now()->subDays(1)->format('Y-m-d');
    //     $endDate = now()->format('Y-m-d');
    //     $order = Order::all();

    //     return view('laporan', compact('product', 'categories', 'user', 'order', 'order_item', 'startDate', 'endDate'));
    // }


    // public function filter(Request $request)
    // {
    //     $product = Product::all();
    //     $categories = Categorie::all();
    //     $user = User::all();
    //     $order_item = Order_item::all();

    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');
    //     $order = Order::whereBetween('order_date', [$startDate, $endDate])->get();

    //     return view('laporan', compact('product', 'categories', 'user', 'order', 'order_item', 'startDate', 'endDate'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
