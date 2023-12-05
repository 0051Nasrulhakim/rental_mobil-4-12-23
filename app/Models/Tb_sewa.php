<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_sewa extends Model
{
    use HasFactory;
    protected $table = 'tb_sewa';
    protected $fillable = [
        'tanggal_sewa', 'tanggal_kembali', 'id_mobil', 'id_pengguna', 'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_mobil');
    }

    public function hitungLamaSewa()
    {
        // Cek apakah sudah ada tanggal kembali
        if ($this->tanggal_kembali) {
            $tanggalSewa = \Carbon\Carbon::parse($this->tanggal_sewa);
            $tanggalKembali = \Carbon\Carbon::parse($this->tanggal_kembali);
            return $tanggalSewa->diffInDays($tanggalKembali);
        } else {
            // Jika tanggal kembali belum ada, hitung lama sewa hingga saat ini
            $tanggalSewa = \Carbon\Carbon::parse($this->tanggal_sewa);
            $tanggalSekarang = \Carbon\Carbon::now('Asia/Jakarta');
            // dd($tanggalSekarang, $tanggalSewa);
            $lamaSewa = $tanggalSewa->diffInDays($tanggalSekarang)+1;
            // dd($lamaSewa);
            return ($lamaSewa == 0) ? $lamaSewa + 1 : $lamaSewa;
        }
    }

}
