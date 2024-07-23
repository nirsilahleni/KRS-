<?php

namespace App\Models\Krs;

use App\Traits\AuditChanges;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringPendampingan extends Model
{
    use HasFactory, AuditChanges, HasUuids;

    protected $table = 'monitoring_pendampingan';

    protected $guarded =[
        'id',
        'created_at',
        'updated_at',
    ];

}
