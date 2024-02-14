<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct() {
        $this->middleware('auth');
        
    }
    public function index()
    {
        $product = Product::all();
        $products = Product::all()->toArray();
        $categories = Categorie::all();
        $user = User::all();

        $orderCount = DB::table('orders')->count() + 1;
        return view('order', compact('product', 'categories', 'user', 'products', 'orderCount'));
    }

    public function store(Request $request)
    {
        // dd(request()->all());
        $orders_id = DB::table('orders')->count() + 1;

        try{
            DB::beginTransaction();     

            DB::table('orders')->insert([
                'order_id' => $orders_id,
                'invoice_id' => $request->nota_id,
                'order_status' =>'on_progress',
                'order_total' => $request->subtotal,
                'user_id' => $request->id_kasir ,
            ]);   
    
                foreach($request['product_id'] as $pr){
                    DB::table('order_items')->insert([
                        'order_id' => $orders_id,
                        'product_id' => $pr ,
                        'product_name' => $request['name'][$pr] ,
                        'product_price' => $request['selling_price'][$pr] ,
                        'qty' => $request['jumlah'][$pr] ,
                        'subtotal' => $request['total'][$pr]
                    ]);     
                }
                DB::commit();

             return redirect('/order')->with('insert','sukses');
          }
          catch(\Exception $exception){
              DB::rollBack();
              dump($exception);
          } 
    }

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
