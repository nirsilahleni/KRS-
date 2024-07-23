<?php

namespace App\Http\Controllers\Monitoring;

use App\DataTables\Monitoring\IbuHamilDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Monitoring\StoreIbuHamilRequest;
use App\Models\Master\Periode;
use App\Models\Monitoring\PendampinganIbuHamil;
use App\Models\Monitoring\PendataanKia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ResponseFormatter;

class MonitoringIbuHamilController extends Controller
{
    protected $modules = ['monitoring', 'monitoring.ibu-hamil'];


    /**
     * Display a listing of the resource.
     */
    public function index(IbuHamilDataTable $datatable)
    {
        $bulan = ltrim(Carbon::now()->format('m'), '0');
        $current_periode = Periode::getCurrent();

        return $datatable->render('pages.admin.monitoring.ibu-hamil.index', compact('bulan','current_periode'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIbuHamilRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            $data['periode_id'] = Periode::getCurrent()['id'];

            $pendataanKIA = PendataanKia::where('kepala_keluarga_id', $data['kepala_keluarga_id'])
                ->where('kepala_keluarga_anggota_id', $data['kepala_keluarga_anggota_id'])
                ->where('periode_id', $data['periode_id'])
                ->first();

            if (!$pendataanKIA) {
                $pendataanKIA = PendataanKia::create([
                    'kepala_keluarga_id' => $data['kepala_keluarga_id'],
                    'kepala_keluarga_anggota_id' => $data['kepala_keluarga_anggota_id'],
                    'periode_id' => $data['periode_id'],
                    'nomor_kia' => $data['nomor_kia'],
                    'tanggal_perkiraan_lahir' => $data['tanggal_perkiraan_lahir'],
                ]);
            }

            $ibu_hamil = PendampinganIbuHamil::create(
                array_merge($data, [
                    'pendataan_kia_id' => $pendataanKIA->id,
                ])
            );

            DB::commit();
            return ResponseFormatter::created('Berhasil menambah data ibu hamil', $ibu_hamil);
        } catch (\Throwable $th) {
            return ResponseFormatter::error('Gagal menambah data ibu hamil, server error', [
                'trace' => $th->getMessage(),

            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PendampinganIbuHamil $ibu_hamil)
    {
        return $this->edit($ibu_hamil);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PendampinganIbuHamil $ibu_hamil)
    {
        return response()->json([
            'kepala_keluarga_id' => [
                'value' => $ibu_hamil->pendataan_kia->kepala_keluarga_id,
                'label' => $ibu_hamil->pendataan_kia->kepala_keluarga->nama_lengkap,
            ],
            'kepala_keluarga_anggota_id' => [
                'value' => $ibu_hamil->pendataan_kia->kepala_keluarga_anggota_id,
                'label' => $ibu_hamil->pendataan_kia->kepala_keluarga_anggota->nama_lengkap,
            ],
            'nomor_kia' => $ibu_hamil->pendataan_kia->nomor_kia,
            'posyandu_id' => [
                'value' => $ibu_hamil->posyandu_id,
                'label' => $ibu_hamil->posyandu->nama_posyandu,
            ],
            'tanggal_perkiraan_lahir' => $ibu_hamil->pendataan_kia->tanggal_perkiraan_lahir,
            ...collect($ibu_hamil)->except(['kepala_keluarga_id','kepala_keluarga_anggota_id', 'posyandu_id', 'nomor_kia', 'tanggal_perkiraan_lahir'])->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreIbuHamilRequest $request, PendampinganIbuHamil $ibu_hamil)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            $pendataanKIA = PendataanKia::findOrFail($ibu_hamil->pendataan_kia_id);
            $pendataanKIA->update($data);

            $ibu_hamil->update($data);

            DB::commit();
            return ResponseFormatter::success('Data ibu hamil berhasil diubah', $ibu_hamil);
        } catch (\Exception $e) {
            return ResponseFormatter::error('Data ibu hamil gagal diubah, server error', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PendampinganIbuHamil $ibu_hamil)
    {
        DB::beginTransaction();
        try {
            $ibu_hamil->deleteOrFail();
            DB::commit();
            return ResponseFormatter::success('Data ibu hamil berhasil dihapus');
        } catch (\Throwable $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
