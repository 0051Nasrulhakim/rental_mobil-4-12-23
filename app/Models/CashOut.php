<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashOut extends Model
{
    use HasFactory;
    protected $table = 'cash_out';
    protected $fillable = [
        'id_mobil', 'id_sewa', 'id_pengguna', 'tanggal_sewa', 'tanggal_kembali', 'jumlah_hari', 'total_biaya'
    ];
}

