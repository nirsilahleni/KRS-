<?php

namespace App\Http\Requests\Krs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreKepalaKeluargaAnggotaRequest extends FormRequest
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
            'nik' => [
                Rule::unique('kepala_keluarga_anggota', 'nik')
                    ->where('kepala_keluarga_id', $this->keluarga->id)
                    ->when($this->anggota, function ($q) {
                        $q->whereNot('id', $this->anggota->id);
                    })->ignore($this->anggota),
                'required',
                'numeric', 'min_digits:16', 'max_digits:16',
            ],
            'nama_lengkap' => 'required|max:200',
            'tempat_lahir' => 'required|max:100',
            'tanggal_lahir' => 'required|date',
            'pekerjaan' => 'nullable|max:100',
            'jenjang_pendidikan_id' => 'nullable|exists:ref_jenjang_pendidikan,id',
            'agama_id' => 'nullable|exists:ref_agama,id',
            'status_hubungan_id' => $this->status_hubungan_id  == "1" ? [
                Rule::unique('kepala_keluarga_anggota', 'status_hubungan_id')
                    ->where('kepala_keluarga_id', $this->keluarga->id)
                    ->when($this->anggota, function ($q) {
                        $q->whereNot('id', $this->anggota->id);
                    }),
                'required', 'exists:ref_status_hubungan,id'
            ] : 'required|exists:ref_status_hubungan,id',
            'jenis_kelamin' => 'required|in:L,P',
        ];
    }

    public function messages(): array
    {
        return [
            'status_hubungan_id.unique' => 'Dalam Keluarga hanya boleh terdapat 1 kepala keluarga',
            'nik.unique' => 'NIK sudah terdaftar Pada keluarga ini',
        ];
    }
}
