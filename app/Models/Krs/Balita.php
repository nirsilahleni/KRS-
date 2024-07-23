<?php

namespace App\Models\Krs;

use App\Models\Master\Interpretasi;
use App\Models\Monitoring\PendampinganBalita;
use App\Traits\AuditChanges;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Balita extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'balita';
    protected $guarded = ['id'];

    public function pendampingan_balita()
    {
        return $this->hasMany(PendampinganBalita::class, 'balita_id', 'id');
    }

    public function kepala_keluarga()
    {
        return $this->belongsTo(KepalaKeluarga::class, 'kepala_keluarga_id', 'id');
    }

    public function interpretasi()
    {
        return $this->belongsTo(Interpretasi::class, 'ref_interpretasi_id', 'id');
    }
}
