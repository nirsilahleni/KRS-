<?php

namespace App\Http\Requests\Master;

use Illuminate\Foundation\Http\FormRequest;

class StoreInterpretasiRequest extends FormRequest
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
        $interpretasi = $this->route('interpretasi');
        return [
            'kode' => 'required|max:10|unique:ref_interpretasi,kode,' . $interpretasi,
            'interpretasi' => 'required|max:100',
            'nilai_minimal' => 'required|between:0,99999.99',
            'nilai_maksimal' => 'required|between:0,99999.99',
            'keterangan' => 'nullable|max:255',
        ];
    }
}
