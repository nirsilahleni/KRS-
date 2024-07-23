<?php

namespace App\Http\Controllers\Krs;

use App\DataTables\Krs\DataKepalaKeluargaDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Krs\StoreDataKepalaKeluargaRequest;
use App\Models\Krs\KepalaKeluarga;
use App\Models\Master\Periode;
use App\Models\Master\StatusKeluarga;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use ResponseFormatter;

class DataKepalaKeluargaController extends Controller
{
    protected $modules = ['krs.data-keluarga'];

    public function index(DataKepalaKeluargaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.krs.keluarga.index');
    }

    public function create()
    {
        $statusKeluarga = StatusKeluarga::all();
        return view('pages.admin.krs.keluarga.create', compact(['statusKeluarga']));
    }

    public function store(StoreDataKepalaKeluargaRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['periode_id'] = Periode::getCurrent()['id'];

        DB::beginTransaction();
        try {
            $kepalaKeluarga = KepalaKeluarga::create($validatedData);
            $kepalaKeluarga->kepala_keluarga_anggota()->create([
                'kepala_keluarga_id' => $kepalaKeluarga->id,
                'status_hubungan_id' => '1',
                'nik' => $kepalaKeluarga->nik,
                'pekerjaan' => '',
                'jenis_kelamin' => 'L',
                'nama_lengkap' => $kepalaKeluarga->nama_lengkap,
            ]);

            DB::commit();
            return ResponseFormatter::created("Berhasil Menambahkan Kepala Keluarga");
        } catch (\Throwable $th) {
            DB::rollBack();
            return ResponseFormatter::error(
                'Gagal menambahkan kepala keluarga, server error',
                [
                    'trace' => $th->getMessage(),
                ],
                500,
            );
        }
    }

    public function show(KepalaKeluarga $keluarga)
    {
        $keluarga->loadMissing(['kecamatan', 'kelurahan', 'status_keluarga']);
        return view('pages.admin.krs.keluarga.show', compact('keluarga'));
    }

    public function edit(KepalaKeluarga $keluarga)
    {
        $keluarga->loadMissing(['kecamatan', 'kelurahan', 'status_keluarga']);
        $statusKeluarga = StatusKeluarga::all();
        return view('pages.admin.krs.keluarga.edit', compact('statusKeluarga', 'keluarga'));
    }

    public function update(StoreDataKepalaKeluargaRequest $request, KepalaKeluarga $keluarga)
    {
        $validatedData = $request->validated();
        DB::beginTransaction();
        try {

            $kepalaKeluargaAnggota = $keluarga->kepala_keluarga_anggota->first();
            if ($kepalaKeluargaAnggota->nama_lengkap !== $validatedData['nama_lengkap']) {
                $kepalaKeluargaAnggota->update([
                    'nama_lengkap' => $validatedData['nama_lengkap'],
                ]);
            }
            
            if ($kepalaKeluargaAnggota->nik !== $validatedData['nik']) {
                $kepalaKeluargaAnggota->update([
                    'nik' => $validatedData['nik'],
                ]);
            }
            
            $keluarga->updateOrFail($request->validated());
            DB::commit();
            return ResponseFormatter::success('Berhasil mengupdate kepala keluarga');
        } catch (\Throwable $th) {
            DB::rollBack();
            return ResponseFormatter::error(
                'Gagal mengupdate kepala keluuarga, server error',
                [
                    'trace' => $th->getMessage(),
                ],
                500,
            );
        }
    }

    public function destroy(KepalaKeluarga $keluarga)
    {
        try {
            $keluarga->delete();
            return ResponseFormatter::success('Berhasil menghapus kepala keluarga');
        } catch (QueryException $th) {
            return ResponseFormatter::error(
                'Gagal menghapus kepala keluarga, karena masih terdapat data lain yang terkait',
                400,
            );
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                'Gagal menghapus kepala keluarga, server error',
                [
                    'trace' => $th->getMessage(),
                ],
                500,
            );
        }
    }

    public function exportJson()
    {
        $keluarga = KepalaKeluarga::with(['anggotaKeluarga.jenjangPendidikan', 'anggotaKeluarga.agama', 'anggotaKeluarga.statusHubungan'])
            ->get()
            ->makeHidden('id');
        $keluarga = $keluarga->map(function ($item) {
            return [
                'nomor_kk' => $item->nomor_kk,
                'nik' => $item->nik,
                'nama_lengkap' => $item->nama_lengkap,
                'provinsi' => $item->provinsi,
                'kabupaten' => $item->kabupaten,
                'rt' => $item->rt,
                'rw' => $item->rw,
                'alamat' => $item->alamat,
                'jumlah_keluarga' => $item->jumlah_keluarga,
                'ref_kecamatan' => [
                    'kode_kecamatan' => optional($item->kecamatan)->kode_kecamatan,
                    'nama_kecamatan' => optional($item->kecamatan)->nama_kecamatan,
                    'latitude' => optional($item->kecamatan)->latitude,
                    'keterangan' => optional($item->kecamatan)->longitude,
                    'keterangan' => optional($item->kecamatan)->keterangan,
                ],
                'ref_kelurahan' => [
                    'kode_kelurahan' => optional($item->kelurahan)->kode_kelurahan,
                    'nama_kelurahan' => optional($item->kelurahan)->nama_kelurahan,
                    'latitude' => optional($item->kelurahan)->latitude,
                    'longitude' => optional($item->kelurahan)->longitude,
                    'keterangan' => optional($item->kelurahan)->keterangan,
                ],
                'ref_status_keluarga' => [
                    'kode' => optional($item->statusKeluarga)->kode,
                    'status_keluarga' => optional($item->statusKeluarga)->status_keluarga,
                    'keterangan' => optional($item->statusKeluarga)->keterangan,
                ],
                'ref_periode' => [
                    'tahun' => optional($item->periode)->tahun,
                    'tanggal_mulai' => optional($item->periode)->tanggal_mulai,
                    'tanggal_selesai' => optional($item->periode)->tanggal_selesai,
                    'is_active' => optional($item->periode)->is_active,
                ],
                'anggota_keluarga' => $item->anggotaKeluarga->map(function ($anggota) {
                    return [
                        'nik' => $anggota->nik,
                        'nama_lengkap' => $anggota->nama_lengkap,
                        'tempat_lahir' => $anggota->tempat_lahir,
                        'tanggal_lahir' => $anggota->tanggal_lahir,
                        'pekerjaan' => $anggota->pekerjaan,
                        'jenis_kelamin' => $anggota->jenis_kelamin,
                        'ref_jenjang_pendidikan' => [
                            'kode' => optional($anggota->jenjangPendidikan)->kode,
                            'nama_jenjang' => optional($anggota->jenjangPendidikan)->nama_jenjang,
                            'keterangan' => optional($anggota->jenjangPendidikan)->keterangan,
                        ],
                        'ref_agama' => [
                            'agama' => optional($anggota->agama)->agama,
                            'keterangan' => optional($anggota->agama)->keterangan,
                        ],
                        'ref_status_hubungan' => [
                            'kode' => optional($anggota->statusHubungan)->kode,
                            'status_hubungan' => optional($anggota->statusHubungan)->status_hubungan,
                            'keterangan' => optional($anggota->statusHubungan)->keterangan,
                        ],
                    ];
                }),
            ];
        });

        $jsonData = json_encode($keluarga, JSON_PRETTY_PRINT);
        $fileName = 'keluarga.json';
        return response()->streamDownload(
            function () use ($jsonData) {
                echo $jsonData;
            },
            $fileName,
            ['Content-Type' => 'application/json'],
        );
    }
}
