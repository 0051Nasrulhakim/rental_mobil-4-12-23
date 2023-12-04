<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('home', compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function sewa($id_mobil)
    {
        $product = Product::findOrFail($id_mobil);
        dd($product);
        // return view('products.show', compact('product'))
        // return view('home', compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    
}
