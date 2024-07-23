<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandarDeviasi extends Model
{
    use HasFactory;

    protected $table = 'ref_standar_deviasi_berdasarkan_umur';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
}
