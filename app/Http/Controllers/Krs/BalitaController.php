<?php

namespace App\Http\Controllers\Krs;

use App\DataTables\Krs\BalitaDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Krs\StoreBalitaRequest;
use App\Models\Krs\Balita;
use App\Models\Master\Interpretasi;
use App\Models\Master\Periode;
use Illuminate\Http\Request;
use ResponseFormatter;

class BalitaController extends Controller
{
    protected $modules = ['krs', 'krs.data-balita'];
    /**
     * Display a listing of the resource.
     */
    public function index(BalitaDataTable $datatable)
    {
        return $datatable->render('pages.admin.krs.balita.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBalitaRequest $request)
    {
        // randomize index value
        $random_index_val = mt_rand(0, 250) / 100;

        $res = Balita::create([
            "ref_interpretasi_id" => Interpretasi::getFromGivenValue($random_index_val)->id,
            "periode_id" => Periode::getCurrent()['id'],
            ...$request->validated(),
        ]);
        if ($res) {
            return ResponseFormatter::created('Data balita berhasil ditambahkan', $res);
        } else {
            return ResponseFormatter::error('Data balita gagal ditambahkan', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Balita $balita)
    {
        return $this->edit($balita);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Balita $balita)
    {
        return response()->json([
            'kepala_keluarga_id' => [
                'value' => $balita->kepala_keluarga_id,
                'label' => $balita->kepala_keluarga->nama_lengkap,
            ],
            'tinggi_badan' => number_format($balita->tinggi_badan, 1),
            ...collect($balita)->except(['kepala_keluarga_id','tinggi_badan'])->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBalitaRequest $request, Balita $balita)
    {
        try {
            $balita->updateOrFail($request->validated());
            return ResponseFormatter::success('Data balita berhasil diubah', $balita);
        } catch (\Exception $e) {
            return ResponseFormatter::error('Data balita gagal diubah, server error', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Balita $balita)
    {
        try {
            $balita->deleteOrFail();
            return ResponseFormatter::success('Data balita berhasil dihapus');
        } catch (\Throwable $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
