<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    protected $table = 'tbl_keluarga';
    protected $primaryKey = 'id_keluarga';

    protected $fillable = [
        'nomor_induk_keluarga',
        'nama_kepala_keluarga',
        'alamat',
        'kecamatan',
        'kota',
        'nomor_telepon',
        'jumlah_anggota',
        'status_keluarga',
        'catatan',
    ];

    protected $casts = [
        'jumlah_anggota' => 'integer',
        'status_keluarga' => 'string',
    ];
}
