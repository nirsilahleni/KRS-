<?php

namespace App\Http\Requests\Krs;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataKepalaKeluargaRequest extends FormRequest
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
        return [
            'nomor_kk' => ['required', 'numeric', 'min_digits:16', 'max_digits:50', 'unique:kepala_keluarga,nomor_kk,' . $this->keluarga?->id],
            'nik' => ['required', 'numeric', 'min_digits:16', 'max_digits:16'],
            'nama_lengkap' => ['required', 'max:200'],
            'kecamatan_id' => ['required', 'exists:ref_kecamatan,id'],
            'kelurahan_id' => ['required', 'exists:ref_kelurahan,id'],
            'status_keluarga_id' => ['required', 'exists:ref_status_keluarga,id'],
            'rt' => ['required', 'max_digits:3', 'numeric'],
            'rw' => ['required', 'max_digits:3', 'numeric'],
            'alamat' => ['required', 'max:200'],
        ];
    }
}
