<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class StoreKelurahanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kecamatan_id' => 'required|exists:ref_kecamatan,id',
            'kode_kelurahan' => 'required|max:10|unique:ref_kelurahan,kode_kelurahan',
            'nama_kelurahan' => 'required|max:100',
            'latitude' => 'nullable|max:50',
            'longitude' => 'nullable|max:50',
            'keterangan' => 'nullable',
        ];
    }
}
