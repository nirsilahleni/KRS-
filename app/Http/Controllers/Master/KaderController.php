<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\controller;
use App\DataTables\Master\KaderDataTable;
use App\Models\Master\Kader;
use illuminate\Http\Request;
use ResponseFormatter;
use App\Http\Requests\Master\StoreKaderRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class KaderController extends Controller
{
    protected $modules = ["data-master.kader"];
    protected $actions = [];


    public function index(KaderDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.master.kader.index');
    }

    public function create(Request $request)
    {
        $datakader = Kader::all();
        return view('pages.admin.master.kader.create', compact('datakader'));
    }

    public function store(StoreKaderRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $kader = User::create([
                'name' => $data['nama_lengkap'],
                'email' => $data['email'],
                'password' => Hash::make('12345'),
            ]);

            $kader->assignRole('kader');

            $kader->remember_token = Str::random(10);
            $kader->email_verified_at = now();
            $kader->save();

            $data['user_id'] = $kader->id;

            if (substr($data['nomor_hp'], 0, 1) == '0') {
                $data['nomor_hp'] = '62' . substr($data['nomor_hp'], 1);
            }

            Kader::create($data);
            DB::commit();
            return ResponseFormatter::created("Data Kader Berhasil Ditambahkan");
        } catch (\Exception $th) {
            DB::rollBack();
            return ResponseFormatter::error("Gagal Menambahkan Data Kader, server error", [
                'trace' => $th->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Kader $kader)
    {
        return Response()->json([
            ...collect($kader->toArray()),
            'kecamatan_id' => [
                'value' => $kader->kecamatan_id,
                'label' => $kader->kecamatan->nama_kecamatan
            ],
            'kelurahan_id' => [
                'value' => $kader->kelurahan_id,
                'label' => $kader->kelurahan->nama_kelurahan
            ],
            'posyandu_id' => [
                'value' => $kader->posyandu_id,
                'label' => $kader->posyandu->nama_posyandu
            ],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kader $kader)
    {
        return view('pages.admin.master.kader.edit', [
            'kader' => $kader->load(['kecamatan', 'kelurahan', 'posyandu'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreKaderRequest $request, Kader $kader)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {

            if ($kader->email != $data['email']) {
                $user = User::where('email', $kader->email)->first();
                $user->update(['email' => $data['email']]);
            }

            if ($kader->user->name != $data['nama_lengkap']) {
                $kader->user->update(['name' => $data['nama_lengkap']]);
            }

            if (substr($data['nomor_hp'], 0, 1) == '0') {
                $data['nomor_hp'] = '62' . substr($data['nomor_hp'], 1);
            }

            $kader->update($data);
            DB::commit();
            return ResponseFormatter::created("Data Kader Berhasil Diubah");
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error("Gagal Mengubah Data Kader, server error", code: 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kader $kader)
    {
        $user_id = $kader->user_id;
        DB::beginTransaction();
        try {
            $kader->deleteOrFail();
            $user = User::find($user_id);
            if ($user) {
                $user->delete();
            }
            DB::commit();
            return ResponseFormatter::success('Data Kader Berhasil Dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return ResponseFormatter::error('Gagal Menghapus Data Kader, server error', code: 500);
        }
    }
}
