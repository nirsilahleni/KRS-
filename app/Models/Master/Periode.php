<?php

namespace App\Models\Master;

use App\Models\Krs\KepalaKeluarga;
use App\Models\Monitoring\PendampinganBalita;
use App\Models\Monitoring\PendampinganIbuHamil;
use App\Models\Monitoring\PendataanKia;
use App\Traits\RestrictOnDelete;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periode extends Model
{
    use HasFactory, RestrictOnDelete;
    protected $table = 'ref_periode';
    protected $guarded = ['id'];

    protected $ignoreOnDelete = [''];

    protected static function boot(){
        parent::boot();
        static::creating(function($model){
            $model->deactivateAll();
            $model->is_active = '1';
            $model->created_by = auth()->user()->id ?? '1';
            $model->created_at = now('Asia/Jakarta');
        });
        static::updating(function($model){
            $model->updated_by = auth()->user()->id ?? '1';
            $model->updated_at = now('Asia/Jakarta');
        });
    }

    public function kepala_keluarga() {
        return $this->hasMany(KepalaKeluarga::class, 'periode_id', 'id');
    }

    public function pendampingan_balita() {
        return $this->hasMany(PendampinganBalita::class, 'periode_id', 'id');
    }

    public function pendampingan_ibu_hamil() {
        return $this->hasMany(PendampinganIbuHamil::class, 'periode_id', 'id');
    }

    public function pendataan_kia()
    {
        return $this->hasMany(PendataanKia::class, 'periode_id', 'id');
    }

    public function deactivateAll($except = null)
    {
        self::where('id', '!=', $except)->update(['is_active' => '0']);
    }

    /**
     * Get current active academic year
     *
     * @return array|null
     */
    public static function getCurrent(): ?array
    {
        $data = self::where('is_active', '1')->first();
        if ($data) {
            return $data->toArray();
        }
        return null;
    }
}
