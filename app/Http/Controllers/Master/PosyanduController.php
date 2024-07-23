<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\PosyanduDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\Posyandu\StorePosyanduRequest;
use App\Models\Master\Posyandu;
use App\Models\Master\Kecamatan;
use App\Models\Master\Kelurahan;
use ResponseFormatter;


class PosyanduController extends Controller
{
    protected $modules = ['data-master', 'data-master.posyandu'];

    public function index(PosyanduDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.posyandu.index',  ['kecamatans' => Kecamatan::all()],  ['kelurahans' => Kelurahan::all()]);
    }

    public function store(StorePosyanduRequest $request)
    {
        try {
            $res = Posyandu::create($request->validated());
            return ResponseFormatter::created("Data Posyandu Berhasil Ditambahkan", $res);
        } catch (\Throwable $th) {
            return ResponseFormatter::error("Gagal Menambahkan Data Posyandu, server error", [
                'trace' => $th->getMessage()
            ], 500);
        }
        // return redirect()->route('pages.admin.master.posyandu.index');
    }

    public function update(StorePosyanduRequest $request, Posyandu $posyandu)
    {
        try {
            $posyandu->updateOrFail($request->validated());
            return ResponseFormatter::created("Data Posyandu Berhasil Ditambahkan", $posyandu);
        } catch (\Throwable $th) {
            return ResponseFormatter::error("Gagal Menambahkan Data Posyandu, server error", [
                'trace' => $th->getMessage()
            ], 500);
        }
    }

    public function edit(Posyandu $posyandu)
    {
        return Response()->json([
            ...collect($posyandu->toArray()),
            'kecamatan_id' => [
                'value' => $posyandu->kecamatan->id,
                'label' => $posyandu->kecamatan->nama_kecamatan
            ], 'kelurahan_id' => [
                'value' => $posyandu->kelurahan->id,
                'label' => $posyandu->kelurahan->nama_kelurahan
            ]
        ]);
    }

    public function destroy(Posyandu $posyandu)
    {
        try {
            $posyandu->deleteOrFail();
            return ResponseFormatter::success('Data Posyandu Berhasil Dihapus');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Gagal Menghapus Data Posyandu, server error', [
                'trace' => $e->getMessage()
            ], 500);
        }
    }
}
