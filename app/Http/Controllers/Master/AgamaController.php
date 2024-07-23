<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreAgamaRequest;
use App\DataTables\Master\AgamaDataTable;
use Illuminate\Http\Request;
use App\Models\Master\Agama;
use ResponseFormatter;

class AgamaController extends Controller
{
    protected $modules = ["data-master.agama"];

    public function index(AgamaDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.agama.index');
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
    public function store(StoreAgamaRequest $request)
    {
        try {
            Agama::create($request->validated());
            return ResponseFormatter::created("Data Agama Berhasil Ditambahkan");
        } catch (\Throwable $th) {
            return ResponseFormatter::error("Gagal Menambahkan Data Agama , server error", [
                'trace' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Agama $agama)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agama = Agama::find($id);
        return response()->json($agama);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAgamaRequest $request, string $id)
    {
        try {
            $agama = Agama::find($id);
            $agama->update($request->validated());
            return ResponseFormatter::created("Data Agama Berhasil Diubah");
        } catch (\Throwable $th) {
            return ResponseFormatter::error('Gagal Mengubah Data Agama, server error', [
                'trace' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agama $agama)
    {
        try {
            $agama->deleteOrFail();
            return ResponseFormatter::success('Data Agama Berhasil Dihapus');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Gagal Menghapus Data Agama, server error', [
                'trace' => $e->getMessage()
            ], 500);
        }
    }
}
