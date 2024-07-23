<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\PeriodeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\Periode\StorePeriode;
use App\Http\Requests\Master\Periode\UpdatePeriode;
use App\Models\Master\Periode;
use Exception;
use Illuminate\Support\Facades\DB;
use ResponseFormatter;
// use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PeriodeDataTable $dataTable)
    {
        //
        return $dataTable->render('pages.admin.master.periode.index');
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
    public function store(StorePeriode $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            Periode::create($data);
            DB::commit();
            return ResponseFormatter::created('Periode Berhasil Ditambahkan');
        } catch (Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error("Gagal menambahkan data, server error", code: 500);
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
    public function edit(Periode $periode)
    {
        return response()->json($periode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePeriode $request, Periode $periode)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $periode = $periode->update($data);
            DB::commit();
            return ResponseFormatter::created('Periode Berhasil Diubah');
        } catch (Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periode $periode)
    {
        try {
            $periode->delete();
            return ResponseFormatter::created('Periode Berhasil Dihapus');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage());
        }
    }
    public function activate(Periode $periode)
    {
        DB::beginTransaction();
        try {
            $periode->update(['is_active' => 1]);
            $periode->deactivateAll($periode->id);
            DB::commit();
            return ResponseFormatter::created('Periode Berhasil Diaktifkan');
        } catch (Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error($e->getMessage());
        }
    }
}
