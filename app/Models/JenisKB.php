<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKB extends Model
{
    use HasFactory;

    protected $table = 'ref_jenis_kb';
    protected $fillable = ['jenis', 'keterangan'];

}
