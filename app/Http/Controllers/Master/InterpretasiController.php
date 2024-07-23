<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreInterpretasiRequest;
use App\DataTables\Master\InterpretasiDataTable;
use Illuminate\Http\Request;
use App\Models\Master\Interpretasi;
use ResponseFormatter;

class InterpretasiController extends Controller
{
    protected $modules = ["data-master.interpretasi"];

    public function index(InterpretasiDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.interpretasi.index');
    }

    /**
     * Show the form for creating a new resource.
     * 
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInterpretasiRequest $request)
    {
        try {
            Interpretasi::create($request->validated());
            return ResponseFormatter::created("Data Interpretasi Berhasil Ditambahkan");
        } catch (\Throwable $th) {
            return ResponseFormatter::error("Gagal Menambahkan Data Interpretasi , server error", [
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
        $interpretasi= Interpretasi::find($id);
        return response()->json($interpretasi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreInterpretasiRequest $request, string $id)
    {
        try {
            $interpretasi = Interpretasi::find($id);
            $interpretasi->update($request->validated());
            return ResponseFormatter::created("Data Interpretasi Berhasil Diubah");
        } catch (\Throwable $th) {
            return ResponseFormatter::error('Gagal Mengubah Data Interpretasi, server error', [
                'trace' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interpretasi $interpretasi)
    {
        try {
            $interpretasi->deleteOrFail();
            return ResponseFormatter::success('Data Interpretasi Berhasil Dihapus');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Gagal Menghapus Data Interpretasi, server error', [
                'trace' => $e->getMessage()
            ], 500);
        }
    }
}
