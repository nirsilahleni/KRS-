<?php

namespace App\Models\Monitoring;

use App\Models\Krs\KepalaKeluarga;
use App\Models\Krs\KepalaKeluargaAnggota;
use App\Models\Master\Periode;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendataanKia extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'pendataan_kia';
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = auth()->user()->id ?? '1';
            $model->updated_by = auth()->user()->id ?? '1';
            $model->created_at = now('Asia/Jakarta')->format('Y-m-d H:i:s');
        });
        static::updating(function ($model) {
            $model->updated_by = auth()->user()->id;
            $model->updated_at = now('Asia/Jakarta')->format('Y-m-d H:i:s');
        });
    }

    public function pendampingan_ibu_hamil() {
        return $this->hasMany(PendampinganIbuHamil::class, 'pendataan_kia_id', 'id');
    }

    public function kepala_keluarga()
    {
        return $this->belongsTo(KepalaKeluarga::class, 'kepala_keluarga_id', 'id');
    }

    public function kepala_keluarga_anggota()
    {
        return $this->belongsTo(KepalaKeluargaAnggota::class, 'kepala_keluarga_anggota_id', 'id');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id', 'id');
    }
}
