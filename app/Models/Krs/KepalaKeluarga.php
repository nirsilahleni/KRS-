<?php

namespace App\Models\Krs;

use App\Models\Master\Periode;
use App\Models\Master\Kecamatan;
use App\Models\Master\Kelurahan;
use App\Models\Master\StatusKeluarga;
use App\Models\Monitoring\PendataanKia;
use App\Traits\AuditChanges;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class KepalaKeluarga extends Model
{
    use HasFactory, HasUuids, AuditChanges;
    protected $table = 'kepala_keluarga';
    public $breadcrumbLabelCol = 'nama_lengkap';
    protected $guarded = ['id'];


    public function kepala_keluarga_anggota()
    {
        return $this->hasMany(KepalaKeluargaAnggota::class, 'kepala_keluarga_id', 'id');
    }

    public function pendataan_kia()
    {
        return $this->hasMany(PendataanKia::class, 'kepala_keluarga_id', 'id');
    }

    public function pendataan_krs()
    {
        return $this->hasMany(PendataanKrs::class, 'kepala_keluarga_id', 'id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'id');
    }

    public function status_keluarga()
    {
        return $this->belongsTo(StatusKeluarga::class, 'status_keluarga_id', 'id');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id', 'id');
    }
}
