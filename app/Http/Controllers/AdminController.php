<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tb_sewa;
use App\Models\CashOut;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.index');
    }

    public function riwayat_admin()
    {
        $riwayatSewa = Tb_sewa::select('tb_sewa.*', 'products.nomor_plat', 'products.merek')
            ->leftJoin('products', 'tb_sewa.id_mobil', '=', 'products.id_mobil')
            ->get();
        return view('admin.riwayat', compact('riwayatSewa'));
        // return view('riwayat', compact('riwayatSewa'));
    }

    public function detail($id)
    {

        $dataCashOut = CashOut::where('cash_out.id_sewa', $id)
            ->join('tb_sewa', 'cash_out.id_sewa', '=', 'tb_sewa.id_sewa')
            ->join('users', 'cash_out.id_pengguna', '=', 'users.id')
            ->join('products', 'cash_out.id_mobil', '=', 'products.id_mobil')
            ->select('cash_out.*', 'products.nomor_plat', 'products.merek', 'users.nama', 'users.email', 'users.alamat', 'users.nomor_telfon', 'users.nomor_sim')
            ->first();

        if ($dataCashOut == null || $dataCashOut == '') {
            // Lakukan join ke tabel Tb_sewa dan Products, serta tambahkan join ke tabel Pengguna
            $riwayatSewa = Tb_sewa::where('id_sewa', $id)
                ->join('products', 'tb_sewa.id_mobil', '=', 'products.id_mobil')
                ->join('users', 'tb_sewa.id_pengguna', '=', 'users.id') // Sesuaikan dengan kolom yang menghubungkan users dengan Tb_sewa
                ->select('tb_sewa.*', 'products.nomor_plat', 'products.merek', 'products.tarif_harian', 'users.nama', 'users.email', 'users.alamat', 'users.nomor_telfon', 'users.nomor_sim') // Sesuaikan dengan kolom yang ingin ditampilkan
                ->get();
            return view('admin.detail_riwayat', compact('riwayatSewa'));
        }

        return view('admin.riwayat_selesai', compact('dataCashOut'));
    }

    public function selesaikanPenyewaan(Request $request)
    {
        // Validasi request jika diperlukan
        $request->validate([
            'id_mobil' => 'required',
            'id_sewa' => 'required',
            'id_pengguna' => 'required',
            'tanggal_sewa' => 'required',
            'tanggal_kembali' => 'required',
            'jumlah_hari' => 'required',
            'total_biaya' => 'required',
        ]);

        // Tambahkan logika penyewaan selesai ke dalam database atau proses yang diperlukan
        // Misalnya, simpan informasi ke dalam tabel CashOut atau lakukan tindakan lain sesuai kebutuhan
        CashOut::create([
            'id_mobil' => $request->id_mobil,
            'id_sewa' => $request->id_sewa,
            'id_pengguna' => $request->id_pengguna,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jumlah_hari' => $request->jumlah_hari,
            'total_biaya' => $request->total_biaya,
        ]);

        // Update data pada model Tb_sewa dengan menambahkan tanggal kembali
        Tb_sewa::where('id_sewa', $request->id_sewa)
            ->update(['tanggal_kembali' => $request->tanggal_kembali, 'status' => 'dikembalikan']);

        return redirect()->route('admin.riwayat_admin')->with('success', 'Penyewaan selesai berhasil ditandai.');
    }
}
