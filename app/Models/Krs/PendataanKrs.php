<?php

namespace App\Models\Krs;

use App\Models\TingkatKesejahteraan;
use App\Traits\AuditChanges;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendataanKrs extends Model
{
    use HasFactory, HasUuids, AuditChanges;

    protected $table = 'monitoring_krs';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function kepala_keluarga(){
        return $this->belongsTo(KepalaKeluarga::class);
    }

    public function tingkat_kesejahteraan(){
        return $this->belongsTo(TingkatKesejahteraan::class);
    }

    public function balita(){
        return $this->belongsTo(Balita::class);
    }


}
