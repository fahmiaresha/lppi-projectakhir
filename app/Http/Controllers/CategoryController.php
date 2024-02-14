<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct() {
        $this->middleware('auth');
        
    }
    public function index()
    {
        $categories = Categorie::all();
        return view('category', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Categorie();
        $category->name = $request->nama_kategori_produk;
        if ($request->parent_id) {
            $category->parent_id = $request->parent_id;
        }
        $category->save();

        return redirect('/category')->with('insert', 'berhasil');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Categorie::findOrFail($id);
        $category->name = $request->kategori_produk;
        $category->parent_id = $request->edit_parent_id;
        $category->save();

        return redirect('/category')->with('success', 'Kategori berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Categorie::find($id);
        if ($data) {
            $data->delete();
            return redirect('/category')->with('delete', 'Data berhasil dihapus.');
        }
        return redirect('/category')->with('error', 'Data tidak ditemukan.');
    }
}
