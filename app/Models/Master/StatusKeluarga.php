<?php

namespace App\Models\Master;

use App\Models\Krs\KepalaKeluarga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusKeluarga extends Model
{
    use HasFactory;
    protected $table = 'ref_status_keluarga';
    protected $guarded = ['id'];


    /**
     * boot function for handling created_by and updated_by
     *
     * @return void
     */
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

    public function kepala_keluarga() {
        return $this->hasMany(KepalaKeluarga::class, 'status_keluarga_id', 'id');
    }
}
