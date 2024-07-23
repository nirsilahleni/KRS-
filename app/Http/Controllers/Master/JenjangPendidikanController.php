<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\DataTables\Master\JenjangPendidikanDataTable;
use App\Http\Requests\Master\StoreJenjangPendidikanRequest;
use Illuminate\Http\Request;
use App\Models\Master\JenjangPendidikan;
use ResponseFormatter;

class JenjangPendidikanController extends Controller
{
    protected $modules = ["data-master.pendidikan"];

    public function index(JenjangPendidikanDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.jenjang-pendidikan.index');
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
    public function store(StoreJenjangPendidikanRequest $request)
    {
        try {
            JenjangPendidikan::create($request->validated());
            return ResponseFormatter::created("Data Jenjang Pendidikan Berhasil Ditambahkan");
        } catch (\Throwable $th) {
            return ResponseFormatter::error("Gagal Menambahkan Data Jenjang Pendidikan , server error", [
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
        $jenjangPendidikan = JenjangPendidikan::find($id);
        return response()->json($jenjangPendidikan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreJenjangPendidikanRequest $request, string $id)
    {
        try {
            $jenjangPendidikan = JenjangPendidikan::find($id);
            $jenjangPendidikan->update($request->validated());
            return ResponseFormatter::created("Data Jenjang Pendidikan Berhasil Diubah");
        } catch (\Throwable $th) {
            return ResponseFormatter::error('Gagal Mengubah Data Jenjang Pendidikan, server error', [
                'trace' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $jenjangPendidikan = JenjangPendidikan::findOrFail($id);
            $jenjangPendidikan->delete();
            return ResponseFormatter::success('Data Jenjang Pendidikan Berhasil Dihapus');
        } catch (\Exception $e) {
            return ResponseFormatter::error('Gagal Menghapus Data Jenjang Pendidikan, server error', [
                'trace' => $e->getMessage()
            ], 500);
        }
    }
}
