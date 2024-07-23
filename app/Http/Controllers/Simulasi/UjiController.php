<?php

namespace App\Http\Controllers\Simulasi;

use App\Http\Controllers\Controller;
use App\Models\Master\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ResponseFormatter;

class UjiController extends Controller
{
    public function periode()  {
        try {
            $periode = new \App\Models\Master\Periode();
            $periode->tahun = '2023';
            $periode->tanggal_mulai = '2023-01-01';
            $periode->tanggal_selesai = '2023-12-31';
            $periode->save();
            return ResponseFormatter::success('Periode berhasil ditambahkan', $periode, 201);
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseFormatter::error('Periode gagal ditambahkan', $th->getMessage(), 400);
        }
    }

    public function wilayahAdministrasi()  {
        DB::beginTransaction();
        try {
            $wilayah = file_get_contents(public_path('json/wilayah-administrasi.json'));
            $wilayah = json_decode($wilayah);

            // grouping by kecamatan
            $kecamatan = [];
            foreach ($wilayah as $item) {
                $kecamatan[$item->kode_kecamatan]['kode_kecamatan'] = $item->kode_kecamatan;
                $kecamatan[$item->kode_kecamatan]['kecamatan'] = $item->kecamatan;
                $kecamatan[$item->kode_kecamatan]['kelurahan'][] = [
                    'kode_desa' => $item->kode_desa,
                    'kode_kecamatan' => $item->kode_kecamatan,
                    'desa' => $item->desa
                ];
            }

            $kecamatan = array_values($kecamatan);

            foreach ($kecamatan as $key => $value) {
                $kec = '';
                $kec = Kecamatan::where('kode_kecamatan', $value['kode_kecamatan'])->first();
                if ($kec != null) {
                    $kec->update([
                        'kode_kecamatan' => $value['kode_kecamatan'],
                        'nama_kecamatan' => $value['kecamatan']
                    ]);
                } else{
                    $kec = new \App\Models\Master\Kecamatan();
                    $kec->kode_kecamatan = $value['kode_kecamatan'];
                    $kec->nama_kecamatan = $value['kecamatan'];
                    $kec->save();
                }
                if ($value['kelurahan'] != null && count($value['kelurahan']) > 0) {
                    foreach ($value['kelurahan'] as $k => $val) {
                        $kel = '';
                        $kel = \App\Models\Master\Kelurahan::where('kode_kelurahan', $val['kode_desa'])->first();
                        if ($kel != null) {
                            $kel->update([
                                'kecamatan_id' => $kec->id,
                                'kode_kelurahan' => $val['kode_desa'],
                                'nama_kelurahan' => $val['desa']
                            ]);
                        } else {
                            $kelurahan = new \App\Models\Master\Kelurahan();
                            $kelurahan->kecamatan_id = $kec->id;
                            $kelurahan->kode_kelurahan = $val['kode_desa'];
                            $kelurahan->nama_kelurahan = $val['desa'];
                            $kelurahan->save();
                        }
                    }
                }
            }
            DB::commit();
            return ResponseFormatter::success('Data wilayah administrasi berhasil diambil', $kecamatan);
        } catch (\Throwable $th) {
            DB::rollBack();
            return ResponseFormatter::error('Data wilayah administrasi gagal diambil', $th->getMessage(), 400);
        }
    }
}
