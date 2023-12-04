<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_mobil', 'merek', 'model', 'nomor_plat', 'tarif_harian', 'created_at', 'updated_at'
    ];
}
