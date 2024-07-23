<?php

namespace App\Models\Master;

use App\Models\KRS\Balita;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Interpretasi extends Model
{
    use HasFactory;
    protected $table = 'ref_interpretasi';
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

    public function balita()
    {
        return $this->hasMany(Balita::class, 'ref_interpretasi_id', 'id');
    }

    /**
     * Get interpretasi from given value
     */
    public static function getFromGivenValue(float $value): ?Interpretasi
    {
        return self::where('nilai_minimal', '<=', $value)
            ->where('nilai_maksimal', '>=', $value)
            ->first();
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
