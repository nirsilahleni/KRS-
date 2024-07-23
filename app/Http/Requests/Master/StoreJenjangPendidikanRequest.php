<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class StoreJenjangPendidikanRequest extends FormRequest
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
        $pendidikan = request()->route('pendidikan');
        return [
            'kode' => 'required|max:10|unique:ref_jenjang_pendidikan,kode,' . $pendidikan,
            'nama_jenjang' => 'required|string|max:100',
            'keterangan' => 'nullable|max:255',
        ];
    }
}
