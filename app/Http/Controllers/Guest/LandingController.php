<?php

namespace App\Http\Controllers\Guest;

use App\DataTables\Landing\UnduhDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cms\Dokumen;
use App\Models\Cms\FAQs;
use App\Models\Master\Kecamatan;
use App\Models\Master\Kelurahan;
use App\Models\KRS\Balita;
use Illuminate\Support\Facades\DB;
use App\Models\Cms\SlideShowItem;
use ResponseFormatter;

class LandingController extends Controller
{
    public function index()
    {
        $photo = SlideShowItem::get();
        $faqs = FAQs::where('is_active', '1')->get();
        return view('pages.landing.index', compact('photo', 'faqs'));
    }

    public function chart(Request $request)
    {
        $name = $request->get('name');
        $group = $request->get('group');
        $series = [];
        $categories = [];

        if ($name == "balita") {
            if ($group == 'kecamatan') {
                $aliases = [
                    'L' => 'Laki-laki',
                    'P' => 'Perempuan'
                ];

                $result = [];

                foreach ($aliases as $k => $v) {
                    $balitaOnKecamatan = Kecamatan::leftJoin('kepala_keluarga', 'ref_kecamatan.id', '=', 'kepala_keluarga.kecamatan_id')
                        ->leftJoin('balita', function ($join) use ($k) {
                            $join->on('kepala_keluarga.id', '=', 'balita.kepala_keluarga_id')
                                ->where('balita.jenis_kelamin', $k);
                        })
                        ->select(DB::raw('count(balita.id) as jumlah_balita, ref_kecamatan.nama_kecamatan'))
                        ->groupBy('ref_kecamatan.nama_kecamatan')
                        ->get();

                    foreach ($balitaOnKecamatan as $balita) {
                        $result[$balita->nama_kecamatan][$v] = $balita->jumlah_balita;
                        $series[$v][] = $balita->jumlah_balita;
                    }
                }
                $categories = array_keys($result);

            } else if ($group == 'jenis_kelamin') {
                $aliases = [
                    'L' => 'Laki-laki',
                    'P' => 'Perempuan'
                ];
                foreach ($aliases as $k => $v) {
                    $jumlah_balita = Balita::where('jenis_kelamin', $k)->count();
                    $series[] = $jumlah_balita;
                    $categories[] = $aliases[$k];
                }
            }
        }
        return ResponseFormatter::success('success', [
            'series' => $series,
            'categories' => $categories
        ]);
    }

    public function unduh(UnduhDataTable $dataTable)
    {
        return $dataTable->render('pages.landing.unduh.index');
    }

    public function download($id)
    {
        $document = Dokumen::find($id);
        return $document->download();
    }
}
