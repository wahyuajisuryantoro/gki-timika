<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kebaktian extends Model
{
    protected $table = 'tbl_kebaktian';
    protected $primaryKey = 'id_kebaktian';

    protected $fillable = [
        'id_admin',
        'id_anggota',
        'jenis_kebaktian',
        'nama_kebaktian',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
        'deskripsi',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(OrganisasiAnggota::class, 'id_anggota');
    }
}
