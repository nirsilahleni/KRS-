<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\JsonValidationResponse;
use Illuminate\Validation\Rule;

class StoreKecamatanRequest extends FormRequest
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
        $kecamatan = $this->route('kecamatan');
        return [
            'kode_kecamatan' => 'required|max:10|unique:ref_kecamatan,kode_kecamatan,' . $kecamatan,
            'nama_kecamatan' => 'required|max:100',
            'latitude' => 'nullable|max:50',
            'longitude' => 'nullable|max:50',
            'keterangan' => 'nullable',
        ];
    }
}
