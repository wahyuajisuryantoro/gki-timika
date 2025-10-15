<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'tbl_pendaftaran';
    protected $primaryKey = 'id_pendaftaran';

    protected $fillable = [
        'nomor_induk_jemaat',
        'id_admin',
        'jenis_pendaftaran',
        'nama_lengkap',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'nama_ayah',
        'nama_ibu',
        'saksi1',
        'saksi2',
        'nomor_induk_jemaat_pasangan',
        'nama_pasangan',
        'nama_ayah_pasangan',
        'nama_ibu_pasangan',
        'ktp_pasangan',
        'tanggal_pendaftaran',
        'tanggal_pelaksanaan',
        'status_pendaftaran',
        'catatan',
        'surat_baptis',
        'surat_sidi',
        'kartu_keluarga',
        'ktp',
        'pas_foto',
        'akta_kelahiran',
        'kartu_keluarga_pasangan',
        'surat_baptis_pasangan',
        'surat_sidi_pasangan',
        'pas_foto_pasangan',
        'alamat_pendaftar',
        'alamat_pasangan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_pendaftaran' => 'datetime',
        'tanggal_pelaksanaan' => 'date',
    ];

    public function jemaat()
    {
        return $this->belongsTo(Jemaat::class, 'nomor_induk_jemaat', 'nomor_induk_jemaat');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    public function pasanganJemaat()
    {
        return $this->belongsTo(Jemaat::class, 'nomor_induk_jemaat_pasangan', 'nomor_induk_jemaat');
    }

    public function isPasanganJemaat()
    {
        return !empty($this->nomor_induk_jemaat_pasangan);
    }

}
