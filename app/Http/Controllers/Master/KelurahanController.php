<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Master\KelurahanDataTable;
use App\Http\Requests\Master\StoreKelurahanRequest;
use App\Models\Master\Kecamatan;
use App\Models\Master\Kelurahan;
use ResponseFormatter;

class KelurahanController extends Controller
{
    protected $modules = ["data-master.kelurahan"];

    public function index(KelurahanDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.kelurahan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelurahan = Kelurahan::all();
        return view('pages.admin.master.kelurahan.create', compact('kelurahan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKelurahanRequest $request)
    {
        try {
            Kelurahan::create($request->validated());
            return ResponseFormatter::created("Data Kelurahan Berhasil Ditambahkan");
        } catch (\Throwable $th) {
            return ResponseFormatter::error("Gagal Menambahkan Data Kelurahan, server error", [
                'trace' => $th->getMessage()
            ], 500);
        }
        return redirect()->route('pages.admin.master.kelurahan.index');
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
    public function edit(Kelurahan $kelurahan)
    {
        $kecamatans = Kecamatan::all();
        $kelurahans = Kelurahan::all();
        return view('pages.admin.master.kelurahan.edit', compact('kelurahan', 'kecamatans'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreKelurahanRequest $request, string $id)
    {
        try {
            $kelurahan = Kelurahan::find($id);
            $kelurahan->update($request->validated());
            return ResponseFormatter::created("Data Kelurahan Berhasil Diubah");
        } catch (\Throwable $th) {
            return ResponseFormatter::error('Gagal Mengubah Data Kelurahan, server error', [
                'trace' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelurahan $kelurahan)
    {
        try {
            $kelurahan->deleteOrFail();
            return ResponseFormatter::success('Data Kelurahan Berhasil Dihapus');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Gagal Menghapus Data Kelurahan, server error', [
                'trace' => $e->getMessage()
            ], 500);
        }
    }
}
