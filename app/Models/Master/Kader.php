<?php

namespace App\Models\Master;

use App\Models\User;
use App\Models\Master\Kecamatan;
use App\Models\Master\Kelurahan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Kader extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'kader';
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
            $model->created_by = auth()->user()->id ?? '1';
            $model->updated_by = auth()->user()->id ?? '1';
            $model->created_at = now('Asia/Jakarta')->format('Y-m-d H:i:s');
        });
        static::updating(function ($model) {
            $model->updated_by = auth()->user()->id;
            $model->updated_at = now('Asia/Jakarta')->format('Y-m-d H:i:s');
        });
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function mutator()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
