<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $categories = Categorie::all();

        return view('product', compact('product', 'categories'));
    }

    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->weight = $request->weight;
        $product->img_url = $request->img_url;
        $product->save();

        return redirect('/product')->with('insert', 'Produk berhasil ditambahkan!');
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->weight = $request->weight;
        $product->img_url = $request->img_url;
        $product->save();
        return redirect('/product')->with('update', 'Produk berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('/product')->with('delete', 'Produk berhasil dihapus!');
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


    /**
     * Remove the specified resource from storage.
     */
   
}
