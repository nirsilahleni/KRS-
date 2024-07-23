<?php

namespace App\Http\Requests\Master\Posyandu;

use Illuminate\Foundation\Http\FormRequest;

class StorePosyanduRequest extends FormRequest
{
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
            'nama_posyandu' => 'required|string|max:100',
            'nomor_hp' => 'required|numeric|digits_between:10,15',
            'email' => 'required|email|max:100',
            'kecamatan_id' => 'required|exists:ref_kecamatan,id',
            'kelurahan_id' => 'required|exists:ref_kelurahan,id',
            'rt' => 'required|numeric|max_digits:3',
            'rw' => 'required|numeric|max_digits:3',
            'alamat' => 'required|string|max:255',
            'latitude' => 'nullable|max:50',
            'longitude' => 'nullable|max:50',
        ];
    }
}
