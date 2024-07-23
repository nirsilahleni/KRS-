<?php

namespace App\Models\Master;

use App\Models\Master\Kecamatan;
use App\Models\Master\Kelurahan;
use App\Models\Monitoring\PendampinganIbuHamil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Traits\HasAuthorStamp;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Posyandu extends Model
{
    use HasFactory, HasAuthorStamp, HasUuids;
    protected $table = 'posyandu';
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

    protected $fillable = [
        'nama_posyandu',
        'nomor_hp',
        'email',
        'kecamatan_id',
        'kelurahan_id',
        'rt',
        'rw',
        'alamat',
        'created_by',
        'updated_by',
    ];

    public function kader() {
        return $this->hasMany(Kader::class, 'posyandu_id', 'id');
    }

    public function pendampingan_ibu_hamil() {
        return $this->hasMany(PendampinganIbuHamil::class, 'posyandu_id', 'id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'id');
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
