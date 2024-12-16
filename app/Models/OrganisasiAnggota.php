<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrganisasiAnggota extends Model
{
    protected $table = 'tbl_organisasi_anggota';

    protected $fillable = [
        'kategori_id',
        'nama',
        'jabatan',
        'foto',
        'urutan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(OrganisasiKategori::class, 'kategori_id');
    }
}
