<?php

namespace App\Http\Requests\Krs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBalitaRequest extends FormRequest
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
            'kepala_keluarga_id' => 'required|exists:kepala_keluarga,id',
            'nik' => [
                "nullable",
                "numeric",
                "max_digits:16",
                Rule::unique('balita', 'nik')
                    ->where(function ($query) {
                        return $query->where('kepala_keluarga_id', $this->kepala_keluarga_id);
                    })
                    ->whereNotNull('nik')
                    ->when($this->balita, function ($query) {
                        $query->whereNot('id', $this->balita->id);
                    })
            ],
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'usia' => 'required|integer',
            'tinggi_badan' => 'required|decimal:1',
            'berat_badan' => 'required|decimal:1,2',
            'perlu_pendampingan' => 'required|in:Y,N'
        ];
    }

    public function messages(): array
    {
        return [
            'nik.unique' => 'Bayi dengan NIK ini sudah terdaftar'
        ];
    }
}
