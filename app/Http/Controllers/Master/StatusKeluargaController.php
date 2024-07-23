<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\StatuskeluargaDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\StoreStatusKeluargaRequest;
use App\Models\Master\StatusKeluarga;
use ResponseFormatter;

class StatusKeluargaController extends Controller
{
    protected $modules = ['users', 'data-master.keluarga'];

    public function index(StatuskeluargaDataTable $dataTable)
    {
        $newCode = 'SK-' . (StatusKeluarga::count() + 1);
        return $dataTable->render('pages.admin.master.status-keluarga.index', compact('newCode'));
    }

    public function store(StoreStatusKeluargaRequest $request)
    {

        $res = StatusKeluarga::create($request->validated());
        if ($res) {
            return ResponseFormatter::success('Berhasil menambah status keluarga', $res);
        } else {
            return ResponseFormatter::error(
                'Gagal menambah status keluuarga, server error',
                500,
            );
        }
    }

    public function edit(StatusKeluarga $sk)
    {
        return response()->json($sk);
    }

    public function update(StoreStatusKeluargaRequest $request, StatusKeluarga $sk)
    {
        try {
            $sk->updateOrFail($request->validated());
            return ResponseFormatter::success('Berhasil mengupdate status keluarga');
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                'Gagal mengupdate status keluuarga, server error',
                [
                    'trace' => $th->getMessage(),
                ],
                500,
            );
        }
    }

    public function destroy(StatusKeluarga $sk)
    {
        try {
            $sk->deleteOrFail();
            return ResponseFormatter::success('Berhasil menghapus status keluarga');
        } catch (\Throwable $th) {
            return ResponseFormatter::error(
                'Gagal menghapus status keluarga, server error',
                [
                    'trace' => $th->getMessage(),
                ],
                500,
            );
        }
    }
}
