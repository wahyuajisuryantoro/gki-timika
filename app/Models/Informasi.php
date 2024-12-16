<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    protected $table = 'tbl_informasi';
    protected $primaryKey = 'id_informasi';

    protected $fillable = [
        'konten',
        'kategori',
        'tanggal_diterbitkan',
        'tanggal_kadaluarsa',
        'gambar',
        'penulis',
        'status',
    ];

    protected $casts = [
        'tanggal_diterbitkan' => 'date',
        'tanggal_kadaluarsa' => 'date',
    ];
}
