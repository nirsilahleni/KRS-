<?php

namespace App\Http\Requests\Master\Periode;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\JsonValidationResponse;

class StorePeriode extends FormRequest
{
    use JsonValidationResponse;
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
            'tahun' => 'required|integer|unique:ref_periode,tahun|min:1900|max:' . date('Y'),
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ];
    }

    public function messages(): array
    {
        return [
            'tahun.required' => 'Tahun harus di isi',
            'tahun.unique' => 'Tahun sudah dipakai',
            'tahun.integer' => 'Tahun harus berisi angka',
            'tahun.min' => 'Tahun tidak boleh kurang 1900',
            'tahun.max' => 'Tahun tidak boleh lebih dari tahun saat ini',
            'tanggal_mulai.required' => 'Tanggal mulai harus di isi',
            'tanggal_mulai.date' => 'Tanggal mulai harus berisi tanggal',
            'tanggal_selesai.required' => 'Tanggal selesai harus di isi',
            'tanggal_selesai.date' => 'Tanggal selesai harus berisi tanggal',
            'tanggal_selesai.after' => 'Tanggal selesai harus setelah tanggal mulai',
        ];
    }
}
