<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('products.index', compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nomor_plat' => 'required',
            'merek' => 'required',
            'model' => 'required',
            'tarif_harian' => 'required',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Product Mobil Berhasil Di tambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id_mobil)
    {
        //
        // $product = Product::find($id_mobil);
        $product = Product::where('id_mobil', $id_mobil)->first();
        return view('products.show', compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id_mobil)
    {
        //
        $product = Product::where('id_mobil', $id_mobil)->first();
        // dd($product);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_mobil)
    {
        //
        $request->validate([
            'nomor_plat' => 'required',
            'merek' => 'required',
            'model' => 'required',
            'tarif_harian' => 'required',
        ]);

        // Melakukan update berdasarkan id_mobil
        $result = Product::where('id_mobil', $id_mobil)->update([
            'nomor_plat' => $request->input('nomor_plat'),
            'merek' => $request->input('merek'),
            'model' => $request->input('model'),
            'tarif_harian' => $request->input('tarif_harian'),
        ]);

        return redirect()->route('products.index')->with('success','Product Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_mobil)
    {
        //
        $Product = Product::where('id_mobil', $id_mobil)->delete();
        return redirect()->route('products.index')->with('success','Data Mobil Berhasil Dihapus');
    }
}
