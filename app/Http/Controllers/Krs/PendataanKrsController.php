<?php

namespace App\Http\Controllers\Krs;

use App\DataTables\Krs\PendataanKrsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Krs\StorePendataanKrsRequest;
use App\Http\Requests\Krs\UpdatePendataanKrsRequest;
use App\Models\JenisKB;
use App\Models\Krs\Balita;
use App\Models\Krs\KepalaKeluargaAnggota;
use App\Models\Krs\PendataanKrs;
use App\Models\Master\Periode;
use App\Models\Master\SumberAir;
use App\Models\Master\TempatBuangAir;
use App\Models\TingkatKesejahteraan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use ResponseFormatter;

class PendataanKrsController extends Controller
{
    protected $modules = ['krs', 'krs.pendataan', 'krs.pendataan.pendataan-krs'];
    /**
     * Display a listing of the resource.
     */
    public function index(PendataanKrsDataTable $datatable)
    {
        $ref_tk = TingkatKesejahteraan::all();
        $ref_tba = TempatBuangAir::all();
        $ref_sumber_air = SumberAir::all();
        $ref_jenis_kb = JenisKB::all();
        return $datatable->render('pages.admin.krs.pendataan.pendataan-krs.index', compact('ref_tk', 'ref_tba', 'ref_sumber_air', 'ref_jenis_kb'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePendataanKrsRequest $request)
    {
        $createdPendataan = PendataanKrs::create(array_merge(
            $request->validated(),
            $this->calculate($request, false),
            [
                'periode_id' => Periode::getCurrent()['id']
            ]
        ));

        if ($createdPendataan) {
            return ResponseFormatter::success("Pendataan KRS berhasil disimpan", $createdPendataan);
        } else {
            return ResponseFormatter::error("Pendataan KRS gagal disimpan, server error", code: 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PendataanKrs $pendataan_krs)
    {
        $pendataan_krs->loadMissing(['kepala_keluarga', 'balita']);
        return response()->json([
            "kepala_keluarga_id" => [
                'value' => $pendataan_krs->kepala_keluarga_id,
                'label' => $pendataan_krs->kepala_keluarga->nama_lengkap,
            ],
            ...collect($pendataan_krs)->except(['kepala_keluarga_id'])->toArray(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PendataanKrs $pendataan_krs)
    {
        // $pendataan_krs->loadMissing(['kepala_keluarga', 'balita']);
        return response()->json([
            "kepala_keluarga_id" => [
                'value' => $pendataan_krs->kepala_keluarga_id,
                'label' => $pendataan_krs->kepala_keluarga->nama_lengkap,
            ],
            ...collect($pendataan_krs)->except(['kepala_keluarga_id'])->toArray(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePendataanKrsRequest $request, PendataanKrs $pendataanKrs)
    {
        $request->merge([
            'kepala_keluarga_id' => $pendataanKrs->kepala_keluarga_id,
        ]);

        try {
            $pendataanKrs->updateOrFail(array_merge(
                $request->validated(),
                $this->calculate($request, false),
                [
                    'periode_id' => Periode::getCurrent()['id'],
                    'kepala_keluarga_id' => $pendataanKrs->kepala_keluarga_id,
                    'balita_id' => $pendataanKrs->balita_id
                ]
            ));
            return ResponseFormatter::success("Pendataan KRS berhasil diupdate", $pendataanKrs);
        } catch (\Throwable $th) {
            return ResponseFormatter::error("Pendataan KRS gagal diupdate, server error", code: 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PendataanKrs $pendataanKrs)
    {
        try {
            $pendataanKrs->deleteOrFail();
            return ResponseFormatter::success("Pendataan KRS berhasil dihapus");
        } catch (\Throwable $th) {
            return ResponseFormatter::error("Pendataan KRS gagal dihapus, server error", code: 500);
        }
    }

    public function calculate(Request $request, bool $ajax = true)
    {
        $badutaCount = Balita::where([
            ['kepala_keluarga_id', $request->kepala_keluarga_id],
            ['usia', '<=', 96]
        ])->count();

        $balitaCount = Balita::where([
            ['kepala_keluarga_id', $request->kepala_keluarga_id],
            ['usia', '>', 96],
            ['usia', '<=', 240]
        ])->count();

        $anakCount = KepalaKeluargaAnggota::where([
            'kepala_keluarga_id' => $request->kepala_keluarga_id
        ])->whereRelation('status_hubungan', function (Builder $query) {
            $query->where('status_hubungan', 'Anak');
        })->count();

        $istri = KepalaKeluargaAnggota::where([
            'kepala_keluarga_id' => $request->kepala_keluarga_id,
        ])->whereRelation('status_hubungan', function (Builder $query) {
            $query->where('status_hubungan', 'Istri');
        })->first();

        $suami = KepalaKeluargaAnggota::where([
            'kepala_keluarga_id' => $request->kepala_keluarga_id
        ])->whereRelation('status_hubungan', function (Builder $query) {
            $query->where('status_hubungan', 'Kepala Keluarga');
        })->first();


        if (!$istri?->exists || !$suami?->exists) {
            return ResponseFormatter::error("Data kepala keluarga tidak valid, pastikan kepala keluarga memiliki istri dan suami, silahkan tambahkan terlebih dahulu", code: 400);
        }

        $umurIstri = Carbon::parse($istri->tanggal_lahir)->age;
        $umurSuami = Carbon::parse($suami->tanggal_lahir)->age;
        $selisih_umur = abs($umurIstri - $umurSuami);
        $res = [
            "punya_baduta" => $badutaCount > 0 ? "ya" : "tidak",
            "punya_balita" => $balitaCount > 0 ? "ya" : "tidak",
            "status_pasangan_usia_subur" => ($umurIstri >= 20 && $umurIstri <= 49) ? "ya" : "tidak",
            "terlalu_muda" => $umurIstri < 20 ? "ya" : "tidak",
            "terlalu_tua" => ($umurIstri >= 35 && $umurIstri <= 40) ? "ya" : "tidak",
            "terlalu_dekat" => $selisih_umur < 2 ? "ya" : "tidak",
            "terlalu_banyak_anak" => $anakCount >= 8 ? "ya" : "tidak",
        ];

        // logic untuk menentukan termasuk beresiko atau tidak

        if ($ajax) {
            return ResponseFormatter::success("Berhasil menghitung logic pendataan", $res);
        } else {
            return $res;
        }
    }
}
