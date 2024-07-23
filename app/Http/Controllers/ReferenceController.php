<?php

namespace App\Http\Controllers;

use App\Models\User;
use ResponseFormatter;
use Illuminate\Http\Request;
use App\Models\Master\Kelurahan;
use App\Models\Cms\KategoriBerita;
use App\Models\Krs\Balita;
use App\Models\Krs\KepalaKeluarga;
use App\Models\Krs\KepalaKeluargaAnggota;
use App\Models\Master\KabupatenKota;
use App\Models\Master\Kecamatan;
use App\Models\Master\Periode;
use App\Models\Master\Provinsi;
use App\Models\Master\Posyandu;
use App\Models\Monitoring\PendataanKia;
use App\Models\Rpl\Asesor;
use App\Models\Rpl\Matakuliah;
use Illuminate\Database\Eloquent\Collection;

class ReferenceController extends Controller
{
    private function formatResults(Collection|array $data, string $key = 'id', string $value = "name", int $limit = 10,  callable $callbackLabel = null)
    {
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }
        $result = [];
        foreach ($data as $item) {
            $result[] = [
                "id" => $item[$key],
                "text" => $callbackLabel ? $callbackLabel($item) : $item[$value]
            ];
        }

        return collect($result)->slice(0, $limit)->values();
    }


    public function user(Request $request)
    {
        $search = $request->get('q');
        $limit = 10;
        $key = 'name';
        $results = User::where($key, 'like', "%{$search}%")
            ->limit($limit)
            ->get();

        $results = $this->formatResults($results, 'id', $key, $limit);
        return ResponseFormatter::success('success', $results);
    }



    public function kategori_berita(Request $request)
    {
        $search = $request->get('q');
        $limit = 10;
        $key = 'name';
        $results = KategoriBerita::where($key, 'like', "%{$search}%")
            ->limit($limit)
            ->get();

        $results = $this->formatResults($results, 'id', $key, $limit);
        return ResponseFormatter::success('success', $results);
    }



    public function icon(Request $request)
    {
        $iconFile =  file_get_contents(public_path('assets/libs/fontawesome/css/all.css'));
        preg_match_all("/\.fa-.*:before/", $iconFile, $matches);
        $result = [];

        foreach ($matches[0] as $match) {
            $name = str_replace([":before", "."], "", $match);
            $result[] = [
                "id" => "fal $name",
                "name" => "fal $name"
            ];
        }

        if ($request->term) {
            $result = collect($result)->filter(function ($value, $key) use ($request) {
                return stripos($value['name'], $request->term);
            })->values()->toArray();
        }

        // $result = $this->generateReference($result);
        $result = $this->formatResults($result);
        return ResponseFormatter::success("success get icons", $result);
    }
    public function kecamatan(Request $request)
    {
        $search = $request->get('q');
        $limit = 10;
        $key = 'nama_kecamatan';
        $results = Kecamatan::where($key, 'like', "%{$search}%")
            ->limit($limit)
            ->get();
        $results = $this->formatResults($results, 'id', $key, $limit);
        return ResponseFormatter::success('success', $results);
    }
    public function kelurahan(Request $request)
    {
        $search = $request->get('q');
        $limit = 10;
        $key = 'nama_kelurahan';

        $queryParams = $request->only(['kecamatan_id']);

        $results = Kelurahan::where($key, 'like', "%{$search}%")
            ->when(isset($queryParams['kecamatan_id']), function ($query) use ($queryParams) {
                return $query->where('kecamatan_id', $queryParams['kecamatan_id']);
            })
            ->limit($limit)
            ->get();
        $results = $this->formatResults($results, 'id', $key, $limit);
        return ResponseFormatter::success('success', $results);
    }

    public function kepala_keluarga(Request $request)
    {
        $search = $request->get('q');
        $limit = 10;
        $key = 'nama_lengkap';
        $results = KepalaKeluarga::where($key, 'like', "%{$search}%")
            ->limit($limit)
            ->get();
        $results = $this->formatResults($results, 'id', $key, $limit);
        return ResponseFormatter::success('success', $results);
    }
    public function nik(Request $request)
    {
        $search = $request->get('q');
        $limit = 10;
        $key = 'nik';

        //KepalaKeluarga??
        $results = KepalaKeluarga::where($key, 'like', "%{$search}%")
            ->limit($limit)
            ->get();
        $results = $this->formatResults($results, 'id', $key, $limit);
        return ResponseFormatter::success('success', $results);
    }

    public function balita(Request $request)
    {
        $search = $request->get('q');
        $params = $request->only(['kepala_keluarga_id','balita_id']);
        $limit = 10;
        $key = 'nama_lengkap';
        $results = Balita::where($key, 'like', "%{$search}%")
            ->when(!empty($params), function ($query) use ($params) {
                $query->where($params);
            })
            ->limit($limit)
            ->get();

        if ($request->has('get_all')) {
            return ResponseFormatter::success('success', $results);
        }
        $results = $this->formatResults($results, 'id', $key, $limit);
        return ResponseFormatter::success('success', $results);
    }

    public function email(Request $request)
    {
        $search = $request->get('q');
        $limit = 10;
        $key = 'email';

        //KepalaKeluarga??
        $results = User::where($key, 'like', "%{$search}%")
            ->limit($limit)
            ->get();
        $results = $this->formatResults($results, 'id', $key, $limit);
        return ResponseFormatter::success('success', $results);
    }
    public function user_id(Request $request)
    {
        $search = $request->get('q');
        $limit = 10;
        $key = 'name';

        $results = User::where($key, 'like', "%{$search}%")
            ->limit($limit)
            ->get();
        $results = $this->formatResults($results, 'id', $key, $limit);
        return ResponseFormatter::success('success', $results);
    }

    public function kelurahan_posyandu(Request $request)
    {
        $results = KepalaKeluarga::where('id', $request->kepala_keluarga_id)->first()?->kelurahan_id;
        return ResponseFormatter::success('success', $results);
    }

    public function posyandu(Request $request)
    {
        $search = $request->get('q');
        $limit = 10;
        $key = 'nama_posyandu';

        $queryParams = $request->only(['kelurahan_id']);

        $results = Posyandu::where($key, 'like', "%{$search}%")
            ->when(isset($queryParams['kelurahan_id']), function ($query) use ($queryParams) {
                return $query->where('kelurahan_id', $queryParams['kelurahan_id']);
            })
            ->limit($limit)
            ->get();
        $results = $this->formatResults($results, 'id', $key, $limit);
        return ResponseFormatter::success('success', $results);
    }

    public function ibu_hamil(Request $request)
    {
        $search = $request->get('q');
        $limit = 10;
        $key = 'nama_lengkap';

        $queryParams = $request->only(['kepala_keluarga_id']);

        $results = KepalaKeluargaAnggota::where('status_hubungan_id', 2)->where($key, 'like', "%{$search}%")
            ->when(isset($queryParams['kepala_keluarga_id']), function ($query) use ($queryParams) {
                return $query->where('kepala_keluarga_id', $queryParams['kepala_keluarga_id']);
            })
            ->limit($limit)
            ->get();

        $results = $this->formatResults($results, 'id', $key, $limit);
        return ResponseFormatter::success('success', $results);
    }

    public function nomor_kia(Request $request)
    {
        $results = PendataanKia::where('kepala_keluarga_id', $request->kepala_keluarga_id)
            ->where('periode_id', Periode::getCurrent()['id'])
            ->first()?->nomor_kia;
        return ResponseFormatter::success('success', $results);
    }

    public function periode(Request $request)
    {
        $search = $request->get('q');
        $limit = 10;
        $key = 'tahun';

        $results = Periode::where($key, 'like', "%{$search}%")
            ->limit($limit)
            ->get();

        $results = $this->formatResults($results, 'id', $key, $limit);
        return ResponseFormatter::success('success', $results);
    }
}
