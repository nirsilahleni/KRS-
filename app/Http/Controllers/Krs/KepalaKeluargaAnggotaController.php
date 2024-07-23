<?php

namespace App\Http\Controllers\Krs;

use App\DataTables\Krs\KepalaKeluargaAnggotaDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Krs\StoreKepalaKeluargaAnggotaRequest;
use App\Models\Krs\Balita;
use App\Models\Krs\KepalaKeluarga;
use App\Models\Krs\KepalaKeluargaAnggota;
use App\Models\Master\Agama;
use App\Models\Master\Interpretasi;
use App\Models\Master\JenjangPendidikan;
use App\Models\Master\Periode;
use App\Models\Master\StatusHubungan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ResponseFormatter;

class KepalaKeluargaAnggotaController extends Controller
{
    protected $modules = ['krs.data-keluarga'];
    public function index(KepalaKeluargaAnggotaDataTable $dataTable, KepalaKeluarga $keluarga)
    {
        $dataTable->setKepalaKeluargaId($keluarga->id);
        return $dataTable->render('pages.admin.krs.keluarga.anggota.index', compact('keluarga'));
    }

    public function create(KepalaKeluarga $keluarga)
    {
        return view('pages.admin.krs.keluarga.anggota.create', compact(['keluarga']));
    }

    public function store(StoreKepalaKeluargaAnggotaRequest $request, KepalaKeluarga $keluarga)
    {
        DB::beginTransaction();
        try {
            $anggota = $keluarga->kepala_keluarga_anggota()->create($request->validated());
            $weekFromNow = Carbon::now()->diffInWeeks(Carbon::parse($anggota->tanggal_lahir));
            // if more than 2 years old then add to balita record also
            if ($weekFromNow <= 96 && $anggota->status_hubungan_id == "3") {
                $random_index_val = mt_rand(0, 250) / 100;
                Balita::create([
                    "kepala_keluarga_id" => $keluarga->id,
                    "nik" => $anggota->nik,
                    "ref_interpretasi_id" => Interpretasi::getFromGivenValue($random_index_val)->id,
                    "periode_id" => Periode::getCurrent()['id'],
                    "nama_lengkap" => $anggota->nama_lengkap,
                    "tempat_lahir" => $anggota->tempat_lahir,
                    "tanggal_lahir" => $anggota->tanggal_lahir,
                    "jenis_kelamin" => $anggota->jenis_kelamin,
                    "usia" => $weekFromNow,
                    "tinggi_badan" => 0,
                    "berat_badan" => 0,
                    "perlu_pendampingan" => 'Y',
                ]);
            }
            DB::commit();
            return ResponseFormatter::created('Berhasil menambah anggota keluarga', $anggota);
        } catch (\Throwable $th) {
            return ResponseFormatter::error('Gagal menambah anggota keluarga, server error',[
                'trace' => $th->getMessage(),

            ], 500);
        }
    }

    public function edit(KepalaKeluarga $keluarga, KepalaKeluargaAnggota $anggota)
    {
        $anggota->loadMissing(['agama', 'jenjang_pendidikan', 'status_hubungan']);
        return view('pages.admin.krs.keluarga.anggota.edit', compact(['anggota']));
    }

    public function update(StoreKepalaKeluargaAnggotaRequest $request, KepalaKeluarga $keluarga, KepalaKeluargaAnggota $anggota)
    {
        try {
            $anggota->updateOrFail($request->validated());
            return ResponseFormatter::success('Berhasil mengupdate anggota kepala keluarga');
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                'Gagal mengupdate kepala keluuarga, server error',
                [
                    'trace' => $th->getMessage(),
                ],
                500,
            );
        }
    }

    public function show(KepalaKeluarga $keluarga, KepalaKeluargaAnggota $anggota)
    {
        $anggota->loadMissing(['agama', 'jenjang_pendidikan', 'status_hubungan']);

        return view('pages.admin.krs.keluarga.anggota.show', compact('anggota'));
    }

    public function destroy(KepalaKeluarga $keluarga, KepalaKeluargaAnggota $anggota)
    {
        try {
            $anggota->delete();
            return ResponseFormatter::success('Berhasil menghapus anggota kepala keluarga', $anggota);
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                'Gagal menghapus kepala keluarga, server error',
                [
                    'trace' => $th->getMessage(),
                ],
                code: 500,
            );
        }
    }
}
