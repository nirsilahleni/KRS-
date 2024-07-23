<?php

namespace App\Http\Requests\Monitoring;

use App\Models\Master\Periode;
use Closure;
use Illuminate\Foundation\Http\FormRequest;

class StorePendampinganBalitaRequest extends FormRequest
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
            "balita_id" => "required|exists:balita,id",
            "bulan" => "required|numeric|min:1|max:12",
            "jenis_pendampingan" => "required|in:KMS,KIA,ASI",
            "tanggal_pendampingan" => [
                "required",
                "date",
                function (string $attribute, mixed $value, Closure $fail) {
                    $date = \DateTime::createFromFormat('Y-m-d', $value);
                    $month = $date->format('m');
                    if ($month != request()->bulan) {
                        $fail(str_replace("_", " ", $attribute) . " Yang diberikan tidak dalam bulan yang sama dengan bulan yang dipilih.");
                    }
                },
                function (string $attribute, mixed $value, Closure $fail) {
                    $date = \DateTime::createFromFormat('Y-m-d', $value);
                    $year = $date->format('Y');
                    $periode = Periode::where("id", request()->periode_id)->firstOrFail();
                    if ($year != $periode->tahun) {
                        $fail(str_replace("_", " ", $attribute) . " Yang diberikan tidak dalam tahun yang dipilih.");
                    }
                },
            ],
            "usia" => "required|numeric|integer",
            "tinggi_badan" => "required|decimal:1",
            "periode_id" => "required|exists:ref_periode,id",
            "berat_badan" => "required|decimal:1,2",
            "keterangan" => "nullable|string"
        ];
    }
}
