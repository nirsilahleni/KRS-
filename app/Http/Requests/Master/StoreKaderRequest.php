<?php

namespace App\Http\Requests\Master;

use App\Models\Master\Kader;
use Illuminate\Foundation\Http\FormRequest;

class StoreKaderRequest extends FormRequest
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
            'nama_lengkap' => 'required|min:3|max:100|string',
            'nik' => 'required|digits:16|numeric|unique:kader,nik,' . $this->kader?->id,
            'tempat_lahir' => 'required|max:50',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'nomor_hp' => 'required|numeric|digits_between:10,15|starts_with:0,62',
            'email' => 'required|email|unique:users,email,' . $this->kader?->user_id,
            'kecamatan_id' => 'required|exists:ref_kecamatan,id',
            'kelurahan_id' => 'required|exists:ref_kelurahan,id',
            'rt' => 'required|numeric|max_digits:3',
            'rw' => 'required|numeric|max_digits:3',
            'alamat' => 'required|max:255',
            'posyandu_id' => 'required|exists:posyandu,id'
        ];
    }
}
