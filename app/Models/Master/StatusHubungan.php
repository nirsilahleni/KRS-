<?php

namespace App\Models\Master;

use App\Models\Krs\KepalaKeluargaAnggota;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusHubungan extends Model
{
    use HasFactory;
    protected $table = 'ref_status_hubungan';
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_by = auth()->user()->id ?? 1;
            $model->created_at = now('Asia/Jakarta');
        });
        static::updating(function ($model) {
            $model->updated_by = auth()->user()->id ?? 1;
            $model->updated_at = now('Asia/Jakarta');
        });
    }

    public function kepala_keluarga_anggota()
    {
        return $this->hasMany(KepalaKeluargaAnggota::class, 'status_hubungan_id', 'id');
    }
}
