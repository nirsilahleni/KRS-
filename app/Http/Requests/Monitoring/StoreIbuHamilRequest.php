<?php

namespace App\Http\Requests\Monitoring;

use App\Models\Master\Periode;
use App\Models\Monitoring\PendampinganIbuHamil;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreIbuHamilRequest extends FormRequest
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
            'kepala_keluarga_anggota_id' => 'required|exists:kepala_keluarga_anggota,id',
            'nomor_kia' => [
                'required',
                'max:16',
                'min:16',
                function (string $attribute, mixed $value, Closure $fail) {
                    $current_periode = Periode::getCurrent()['id'];
                    PendampinganIbuHamil::whereHas('pendataan_kia', function ($query) use ($value, $current_periode) {
                        $query->where('nomor_kia', $this->nomor_kia)
                            ->whereNot("periode_id", $current_periode)

                            ->orWhere(function ($query) use ($current_periode) {
                                $query->where("periode_id", $current_periode)
                                    ->where('nomor_kia', $this->nomor_kia)

                                    ->where("pendampingan_ibu_hamil.bulan", $this->bulan);
                            });
                    })->when($this->ibu_hamil, function ($query) {
                        $query->whereNot('id', $this->ibu_hamil->id);
                    })->exists() ? $fail('Nomor KIA sudah terdaftar pada periode sebelumnya') : null;
                }
            ],
            'bulan' => [
                'required',
                'in:1,2,3,4,5,6,7,8,9,10,11,12',
                function (string $attribute, mixed $value, Closure $fail) {
                    PendampinganIbuHamil::whereHas('pendataan_kia', function ($query) use ($value) {
                        $query->where('nomor_kia', $this->nomor_kia);
                    })->where('bulan', $this->bulan)
                        ->when($this->ibu_hamil, function ($query) {
                            $query->where('id', '!=', $this->ibu_hamil->id);
                        })
                        ->exists() ? $fail('Nomor KIA sudah terdaftar pada bulan tersebut') : null;
                }
            ],
            'posyandu_id' => 'required|exists:posyandu,id',
            'tanggal_perkiraan_lahir' => 'required|date',
            'tanggal_pendampingan' => 'required|date',
            'usia_kehamilan' => 'required|integer',
            'status_kehamilan' => 'required|in:N,Risti,KEK',
            'pemeriksaan_kehamilan' => 'required|in:Y,N',
            'pemeriksaan_nifas' => 'required|in:Y,N',
            'konsumsi_pil_fe' => 'required|in:Y,N',
            'konseling_gizi' => 'required|in:Y,N',
            'kunjungan_rumah' => 'required|in:Y,N',
            'akses_air_bersih' => 'required|in:Y,N',
            'ada_jamban' => 'required|in:Y,N',
            'jaminan_kesehatan' => 'required|in:Y,N',
            'catatan' => 'nullable|string|max:255'
        ];
    }
}
