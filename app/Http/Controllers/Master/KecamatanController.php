<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\KecamatanDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreKecamatanRequest;
use App\Models\Master\Kecamatan;
use Illuminate\Http\Request;
use ResponseFormatter;

class KecamatanController extends Controller
{
    protected $modules = ["data-master.kecamatan"];

    public function index(KecamatanDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.kecamatan.index');
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
    public function store(StoreKecamatanRequest $request)
    {
        try {
            Kecamatan::create($request->validated());
            return ResponseFormatter::created("Data Kecamatan Berhasil Ditambahkan");
        } catch (\Throwable $th) {
            return ResponseFormatter::error("Gagal Menambahkan Data Kecamatan, server error", [
                'trace' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kecamatan = Kecamatan::find($id);
        return response()->json($kecamatan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreKecamatanRequest $request, string $id)
    {
        try {
            $kecamatan = Kecamatan::find($id);
            $kecamatan->update($request->validated());
            return ResponseFormatter::created("Data Kecamatan Berhasil Diubah");
        } catch (\Throwable $th) {
            return ResponseFormatter::error('Gagal Mengubah Data Kecamatan, server error', [
                'trace' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kecamatan $kecamatan)
    {
        if ($kecamatan->kelurahan()->exists()) {
            return ResponseFormatter::error('Gagal Menghapus Data Kecamatan yang Sudah Memiliki Kelurahan');
        } else {
            $kecamatan->deleteOrFail();
            return ResponseFormatter::success('Data Kecamatan Berhasil Dihapus');
        }
    }
}
