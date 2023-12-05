<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tb_sewa;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        $brands = Product::select('merek')->distinct()->pluck('merek');
        $products = Product::query();
        if ($request->has('merek') && !empty($request->merek)) {
            $products->where('merek', $request->merek);
        }
        // $products = $products->get();
        // Tambahkan join ke tb_sewa
        $products->leftJoin('tb_sewa', 'products.id_mobil', '=', 'tb_sewa.id_mobil');

        // Pilih kolom yang ingin ditampilkan
        $products->select('products.*', 'tb_sewa.status');

        $products = $products->get();
        return view('dashboard', compact('products', 'brands'));
    }
    public function sewa($id)
    {
        $identitas = [
            'nama' => Auth::user()->nama,
            'email' => Auth::user()->email,
            'nomor_sim' => Auth::user()->nomor_sim,
            'nomor_telfon' => Auth::user()->nomor_telfon,
            'alamat' => Auth::user()->alamat,
        ];

        $product = Product::where('id_mobil', $id)->first();
        return view('preview', [
            'identitas' => $identitas,
            'product' => $product,
        ]);
    }
    public function checkout(Request $request)
    {
        $data = [
            'id_pengguna' => Auth::user()->id,
            'tanggal_sewa' => $request->input('tanggal_sewa'),
            'id_mobil' => $request->input('id_mobil'),
            'status' => 'disewa'
        ];
        Tb_sewa::create($data);

        // Redirect atau melakukan respons sesuai kebutuhan aplikasi Anda
        return redirect()->route('dashboard')->with('success', 'Sewa berhasil!');
    }
    public function riwayat()
    {
        $id_pengguna = Auth::user()->id;
        $riwayatSewa = Tb_sewa::where('id_pengguna', $id_pengguna)
            ->join('products', 'tb_sewa.id_mobil', '=', 'products.id_mobil')
            ->select('tb_sewa.*', 'products.nomor_plat', 'products.merek', 'products.tarif_harian') // Sesuaikan dengan kolom yang ingin ditampilkan
            ->get();
        // dd($riwayatSewa);
        return view('riwayat', compact('riwayatSewa'));
    }
}
