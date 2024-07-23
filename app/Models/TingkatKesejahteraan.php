<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TingkatKesejahteraan extends Model
{
    use HasFactory;

    protected $table = 'ref_tingkat_kesejahteraan';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];




}
