<?php

namespace App\Models\Master;

use App\Models\Krs\KepalaKeluargaAnggota;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agama extends Model
{
    use HasFactory;
    protected $table = 'ref_agama';
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->user()->id ?? '1';
            $model->created_at = now('Asia/Jakarta');
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->user()->id ?? '1';
            $model->updated_at = now('Asia/Jakarta');
        });
    }

    public function kepala_keluarga_anggota()
    {
        return $this->hasMany(KepalaKeluargaAnggota::class, 'agama_id', 'id');
    }


    public function author()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function mutator()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
