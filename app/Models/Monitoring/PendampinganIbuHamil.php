<?php

namespace App\Models\Monitoring;

use App\Models\Master\Periode;
use App\Models\Master\Posyandu;
use App\Traits\AuditChanges;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendampinganIbuHamil extends Model
{
    use HasFactory, HasUuids, AuditChanges;
    protected $table = 'pendampingan_ibu_hamil';
    protected $guarded = ['id'];

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id', 'id');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id', 'id');
    }

    public function pendataan_kia()
    {
        return $this->belongsTo(PendataanKia::class, 'pendataan_kia_id', 'id');
    }
}
