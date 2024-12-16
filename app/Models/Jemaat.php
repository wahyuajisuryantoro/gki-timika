<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jemaat extends Model
{
    protected $table = 'tbl_jemaat';
    protected $primaryKey = 'id_jemaat';

    protected $fillable = [
        'id_keluarga', 'nomor_induk_jemaat', 'nama_lengkap', 'tanggal_lahir',
        'tempat_lahir', 'jenis_kelamin', 'status_pernikahan', 'alamat_rumah',
        'nomor_telepon', 'email', 'tanggal_baptis', 'tanggal_sidi',
        'status_keanggotaan', 'pekerjaan', 'catatan', 'foto'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_baptis' => 'date',
        'tanggal_sidi' => 'date',
    ];

    public function keluarga(): BelongsTo
    {
        return $this->belongsTo(Keluarga::class, 'id_keluarga');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($jemaat) {
            $jemaat->nomor_induk_jemaat = 'J' . now()->format('Ymd') . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        });
    }
}
