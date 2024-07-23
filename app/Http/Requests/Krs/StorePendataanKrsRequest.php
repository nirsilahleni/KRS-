<?php

namespace App\Http\Requests\Krs;

use App\Models\Master\Periode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePendataanKrsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $currentPeriode = Periode::getCurrent()['id'];
        return [
            'kepala_keluarga_id' => 'required|exists:kepala_keluarga,id',

            'tempat_buang_air_id' => 'required|exists:ref_tempat_buang_air,id',
            'kb_modern_id' => 'required|exists:ref_jenis_kb,id',
            'sumber_air_minum_id' => 'required|exists:ref_sumber_air,id',
            'ada_anggota_keluarga_menikah_tahun_ini' => 'required|in:ya,tidak',
            'ada_ibu_hamil' => 'required|in:ya,tidak',
            'asi_eksklusif' => 'required|in:ya,tidak'
        ];
    }
}
