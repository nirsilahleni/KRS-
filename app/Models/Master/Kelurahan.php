<?php

namespace App\Models\Master;

use App\Models\Krs\KepalaKeluarga;
use App\Models\Master\Kecamatan;
use App\Models\Master\Posyandu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelurahan extends Model
{
    use HasFactory;
    protected $table = 'ref_kelurahan';
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


    public function kepala_keluarga() {
        return $this->hasMany(KepalaKeluarga::class, 'kelurahan_id', 'id');
    }

    public function kader() {
        return $this->hasMany(Kader::class, 'kelurahan_id', 'id');
    }

    public function posyandu() {
        return $this->hasMany(Posyandu::class, 'kelurahan_id', 'id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
    }
}
