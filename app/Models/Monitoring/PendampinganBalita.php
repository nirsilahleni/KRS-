<?php

namespace App\Models\Monitoring;

use App\Models\Krs\Balita;
use App\Models\Master\Periode;
use App\Traits\AuditChanges;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendampinganBalita extends Model
{
    use HasFactory, AuditChanges, HasUuids;
    protected $table = 'pendampingan_balita';
    protected $guarded = ['id'];

    public function balita()
    {
        return $this->belongsTo(Balita::class, 'balita_id', 'id');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id', 'id');
    }
}
