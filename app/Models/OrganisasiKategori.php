<?php

namespace App\Models;

use App\Models\OrganisasiAnggota;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrganisasiKategori extends Model
{
    protected $table = 'tbl_organisasi_kategori';

    protected $fillable = [
        'nama_kategori',
        'slug',
        'deskripsi',
    ];

    public function anggota(): HasMany
    {
        return $this->hasMany(OrganisasiAnggota::class, 'kategori_id');
    }
}
