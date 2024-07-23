<?php

namespace App\Http\Controllers\Krs;

use App\DataTables\Krs\RekapitulasiPendataanAnakDataTable;
use App\Http\Controllers\Controller;
use App\Models\Master\Kelurahan;
use App\Models\Master\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapitulasiPendataanAnakController extends Controller
{
    protected $modules = ['krs', 'krs.pendataan', 'krs.pendataan.rekapitulasi-pendataan-anak'];
    public function index(Request $request)
    {
        $ref_periode = Periode::all();
        $periode = $request->get('periode') ?? Periode::getCurrent()['id'];
        $bulan = $request->get('bulan')?? date('m') ;

        $badutaPendampinganSubquery = DB::table('balita')
            ->join('pendampingan_balita', function ($join) use ($periode, $bulan) {
                $join->on('pendampingan_balita.balita_id', '=', 'balita.id');
                $join->where('pendampingan_balita.periode_id', '=', $periode);
                $join->where('pendampingan_balita.bulan', '=', $bulan);
            })
            ->select(
                'balita.kepala_keluarga_id',
                DB::raw('
                    SUM(CASE WHEN pendampingan_balita.status_tinggi_badan = "Tinggi badan lebih (tall)" THEN 1 ELSE 0 END) as jumlah_baduta_tinggi,
                    SUM(CASE WHEN pendampingan_balita.status_tinggi_badan = "Tinggi badan pendek (stunting)" THEN 1 ELSE 0 END) as jumlah_baduta_pendek,
                    SUM(CASE WHEN pendampingan_balita.status_tinggi_badan = "Tinggi badan sangat pendek (severly stunted)" THEN 1 ELSE 0 END) as jumlah_baduta_sangat_pendek,
                    SUM(CASE WHEN pendampingan_balita.status_tinggi_badan = "Tinggi badan normal" THEN 1 ELSE 0 END) as jumlah_baduta_normal
                ')

            )
            ->where("pendampingan_balita.usia", "<", floor(24 * 4.3))
            ->where("pendampingan_balita.usia", ">", 0)
            ->groupBy('balita.kepala_keluarga_id');

        $balitaPendampinganSub = DB::table('balita')
            ->join('pendampingan_balita', function ($join) use ($periode, $bulan) {
                $join->on('pendampingan_balita.balita_id', '=', 'balita.id');
                $join->where('pendampingan_balita.periode_id', '=', $periode);
                $join->where('pendampingan_balita.bulan', '=', $bulan);
            })
            ->select(
                'balita.kepala_keluarga_id',
                DB::raw('
                    SUM(CASE WHEN pendampingan_balita.status_tinggi_badan = "Tinggi badan lebih (tall)" THEN 1 ELSE 0 END) as jumlah_balita_tinggi,
                    SUM(CASE WHEN pendampingan_balita.status_tinggi_badan = "Tinggi badan pendek (stunting)" THEN 1 ELSE 0 END) as jumlah_balita_pendek,
                    SUM(CASE WHEN pendampingan_balita.status_tinggi_badan = "Tinggi badan sangat pendek (severly stunted)" THEN 1 ELSE 0 END) as jumlah_balita_sangat_pendek,
                    SUM(CASE WHEN pendampingan_balita.status_tinggi_badan = "Tinggi badan normal" THEN 1 ELSE 0 END) as jumlah_balita_normal
                ')

            )
            ->where("pendampingan_balita.usia", "<", floor(60 * 4.3))
            ->where("pendampingan_balita.usia", ">", floor(24 * 4.3))
            ->groupBy('balita.kepala_keluarga_id');

        $data_rekap = Kelurahan::query()
            ->leftJoin('kepala_keluarga', 'kepala_keluarga.kelurahan_id', '=', 'ref_kelurahan.id')
            ->leftJoin('monitoring_krs', function ($join) use ($periode) {
                $join->on('monitoring_krs.kepala_keluarga_id', '=', 'kepala_keluarga.id');
                $join->where('monitoring_krs.periode_id', '=', $periode);
            })
            // Join the balita and monitoring subquery
            ->leftJoinSub($balitaPendampinganSub, 'balita_pendampingan', 'balita_pendampingan.kepala_keluarga_id', '=', 'kepala_keluarga.id')
            ->leftJoinSub($badutaPendampinganSubquery, 'baduta_pendampingan', 'baduta_pendampingan.kepala_keluarga_id', '=', 'kepala_keluarga.id')
            ->select(
                'ref_kelurahan.id',
                'ref_kelurahan.nama_kelurahan',
                DB::raw("
                    SUM(CASE WHEN monitoring_krs.pus_hamil = 'ya' THEN 1 ELSE 0 END) as jumlah_wanita_hamil,
                    SUM(CASE WHEN monitoring_krs.status_pasangan_usia_subur = 'ya' THEN 1 ELSE 0 END) as jumlah_pus,
                    SUM(CASE WHEN monitoring_krs.status_krs = 'beresiko' THEN 1 ELSE 0 END) as jumlah_krs,
                    SUM(CASE WHEN monitoring_krs.punya_baduta = 'ya' THEN 1 ELSE 0 END) as jumlah_keluarga_punya_baduta,
                    SUM(CASE WHEN monitoring_krs.punya_balita = 'ya' THEN 1 ELSE 0 END) as jumlah_keluarga_punya_balita,
                    SUM(balita_pendampingan.jumlah_balita_tinggi) as jumlah_balita_tinggi,
                    SUM(balita_pendampingan.jumlah_balita_pendek) as jumlah_balita_pendek,
                    SUM(balita_pendampingan.jumlah_balita_sangat_pendek) as jumlah_balita_sangat_pendek,
                    SUM(balita_pendampingan.jumlah_balita_normal) as jumlah_balita_normal,
                    SUM(baduta_pendampingan.jumlah_baduta_tinggi) as jumlah_baduta_tinggi,
                    SUM(baduta_pendampingan.jumlah_baduta_pendek) as jumlah_baduta_pendek,
                    SUM(baduta_pendampingan.jumlah_baduta_sangat_pendek) as jumlah_baduta_sangat_pendek,
                    SUM(baduta_pendampingan.jumlah_baduta_normal) as jumlah_baduta_normal
                 ")
            )
            ->groupBy(['ref_kelurahan.id', 'ref_kelurahan.nama_kelurahan'])
            ->get();
            // dd($data_rekap);

        return view('pages.admin.krs.pendataan.rekapitulasi-pendataan.index', compact('data_rekap', 'periode', 'bulan', 'ref_periode'));
    }
}
