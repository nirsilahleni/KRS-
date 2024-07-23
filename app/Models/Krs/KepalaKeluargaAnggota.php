<?php

namespace App\Models\Krs;

use App\Models\Master\Agama;
use App\Models\Krs\KepalaKeluarga;
use App\Models\Master\StatusHubungan;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\JenjangPendidikan;
use App\Models\Monitoring\PendataanKia;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KepalaKeluargaAnggota extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'kepala_keluarga_anggota';
    protected $guarded = ['id'];
    public $breadcrumbLabelCol = 'nama_lengkap';



    public function pendataan_kia()
    {
        return $this->hasMany(PendataanKia::class, 'kepala_keluarga_anggota_id', 'id');
    }

    public function kepala_keluarga()
    {
        return $this->belongsTo(KepalaKeluarga::class, 'kepala_keluarga_id', 'id');
    }

    public function status_hubungan()
    {
        return $this->belongsTo(StatusHubungan::class, 'status_hubungan_id', 'id');
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class, 'agama_id', 'id');
    }

    public function jenjang_pendidikan()
    {
        return $this->belongsTo(JenjangPendidikan::class, 'jenjang_pendidikan_id', 'id');
    }
}
