<?php

namespace App\Http\Controllers\Monitoring;

use App\DataTables\Monitoring\MonitoringBalitaDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Monitoring\ImportPendampinganBalitaRequest;
use App\Http\Requests\Monitoring\StorePendampinganBalitaRequest;
use App\Jobs\ImportDataMonitoringJob;
use App\Models\Krs\Balita;
use App\Models\Master\Periode;
use App\Models\Monitoring\PendampinganBalita;
use App\Models\StandarDeviasi;
use Database\Seeders\StandarDeviasiSeeder;
use DateTime;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use ResponseFormatter;
use SplFileObject;

class MonitoringBalitaController extends Controller
{
    protected $modules = ["monitoring", "monitoring.balita"];
    /**
     * Display a listing of the resource.
     */
    public function index(MonitoringBalitaDataTable $dataTable)
    {
        $ref_periode = Periode::all();
        $current_periode = Periode::getCurrent()["id"];
        return $dataTable->render('pages.admin.monitoring.balita.index', compact('ref_periode', 'current_periode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePendampinganBalitaRequest $request)
    {
        $payloads = $request->validated();
        $umur_bulan = floor($payloads['usia'] / 4);
        $jenis_kelamin = Balita::findOrfail($payloads['balita_id'])->jenis_kelamin;

        $SDTB = StandarDeviasi::where('umur', $umur_bulan)
            ->where('type', 'TB')
            ->where('jenis_kelamin', $jenis_kelamin)->first();

        $SDBB = StandarDeviasi::where('umur', $umur_bulan)
            ->where('type', 'BB')
            ->where('jenis_kelamin', $jenis_kelamin)->first();


        $zscore_tb = zscore($SDTB, $payloads['tinggi_badan']);
        $zscore_bb = zscore($SDBB, $payloads['berat_badan']);

        $newPendampingan = PendampinganBalita::create(array_merge($payloads, [
            "status_berat_badan" => $zscore_bb,
            "status_tinggi_badan" => $zscore_tb
        ]));

        if ($newPendampingan) {
            return ResponseFormatter::success("Pendampingan berhasil disimpan", $newPendampingan, 201);
        }
        return ResponseFormatter::error("Pendampingan gagal disimpan, server error", 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(PendampinganBalita $pendampingan)
    {
        return response()->json([
            "balita_id" => [
                "value" => $pendampingan->balita_id,
                "label" => $pendampingan->balita->nama_lengkap
            ],
            "tinggi_badan" => number_format($pendampingan->tinggi_badan, 1),
            ...collect($pendampingan)->except(["balita_id", "balita", "tinggi_badan"])->toArray()
        ]);
    }

    public function import(ImportPendampinganBalitaRequest $request)
    {

        $file = $request->file('file');
        $path = $file->getRealPath();
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);
        $sheets = collect($spreadsheet->getAllSheets())->map(fn ($item) => $item->getTitle());
        $result = [];

        if ($request->has("initialize")) {
            return ResponseFormatter::success("berhasil mengambil data sheets", [
                "sheets" => $sheets
            ]);
        }

        if ($request->sheet != "all" &&  !$this->checkIsSheetExist($request->sheet, $sheets)) {
            return ResponseFormatter::error("Sheet tidak ditemukan", 400);
        }
        if ($request->sheet  != "all") {
            $sheets = $sheets->filter(fn ($item) => ltrim($item) == ltrim($request->sheet));
        }

        $sheets->each(function ($sheet) use ($spreadsheet, &$result) {
            $sheet = $spreadsheet->getSheetByName($sheet);
            if ($this->isEmptySheet($sheet)) {
                return;
            }
            $desa = $sheet->getCell('L6')->getValue();
            $kecamatan = $sheet->getCell('L7')->getValue();
            $kabupaten = $sheet->getCell('L8')->getValue();
            $provinsi = $sheet->getCell('L10')->getValue();

            $hasNextValue = true;
            $latestDataWilayah = [];

            for ($row_i = 17; $hasNextValue; $row_i++) {
                if ($this->isSeparator($row_i, $sheet)) {
                    $rt = $sheet->getCell('G' . $row_i)->getValue();
                    $desa_rw = $sheet->getCell('T' . $row_i)->getValue();
                    $latestDataWilayah = [
                        "rt" => str_replace("RT ", "", $rt),
                        "dusun" => explode("/", $desa_rw)[0],
                        "rw" => explode("/", $desa_rw)[1],
                    ];
                    continue;
                }
                $NOKK_PP = $sheet->getCell('G' . $row_i)->getValue();
                $namaKepalaKeluarga = $sheet->getCell('J' . $row_i)->getValue();
                $namaIstri = $sheet->getCell('O' . $row_i)->getValue();
                $statusKeluarga = $sheet->getCell('U' . $row_i)->getValue();
                $punyaBaduta = $sheet->getCell('V' . $row_i)->getValue() == "V";
                $punyaBalita = $sheet->getCell('W' . $row_i)->getValue() == "V";
                $PUS = $sheet->getCell('Y' . $row_i)->getValue() == "V";
                $PUSHamil = $sheet->getCell('Z' . $row_i)->getValue() == "V";
                $punyaSumberAirLayak = $sheet->getCell('AC' . $row_i)->getValue() == "X";
                $punyaJambanLayak = $sheet->getCell('AE' . $row_i)->getValue() == "X";
                $terlaluMuda = $sheet->getCell('AK' . $row_i)->getValue() == "V";
                $terlaluTua = $sheet->getCell('AL' . $row_i)->getValue() == "V";
                $terlaluDekat = $sheet->getCell('AM' . $row_i)->getValue() == "V";
                $terlaluBanyakAnak = $sheet->getCell('AM' . $row_i)->getValue() == "V";
                $pesertaKB = $sheet->getCell('AP' . $row_i)->getValue() == "X";
                $beresiko = $sheet->getCell('AS' . $row_i)->getValue() == "V";
                $tingkatKesejahteraan = $sheet->getCell('AV' . $row_i)->getValue();

                $pendampingan_1 = $sheet->getCell('AW' . $row_i)->getValue() == "V";
                $pendampingan_2 = $sheet->getCell('AY' . $row_i)->getValue() == "V";
                $pendampingan_3 = $sheet->getCell('BA' . $row_i)->getValue() == "V";
                $pendampingan_4 = $sheet->getCell('BC' . $row_i)->getValue() == "V";
                $pendampingan_5 = $sheet->getCell('BE' . $row_i)->getValue() == "V";
                $pendampingan_6 = $sheet->getCell('BF' . $row_i)->getValue() == "V";
                $pendampingan_7 = $sheet->getCell('BG' . $row_i)->getValue() == "V";
                $pendampingan_8 = $sheet->getCell('BI' . $row_i)->getValue() == "V";

                $merged = [$pendampingan_1, $pendampingan_2, $pendampingan_3, $pendampingan_4, $pendampingan_5, $pendampingan_6, $pendampingan_7, $pendampingan_8];

                $jenis_pendampingan = null;
                if (in_array(true, $merged)) {
                    $jenis_pendampingan = array_search(true, $merged) + 1;
                }

                $pendidikanIstri = $sheet->getCell('BM' . $row_i)->getValue();
                $asiEksklusif = $sheet->getCell('BN' . $row_i)->getValue();
                $namaBaduta = $sheet->getCell('BO' . $row_i)->getValue();
                $namaBalita = $sheet->getCell('BP' . $row_i)->getValue();

                $tanggalLahir = $sheet->getCell('BQ' . $row_i)->getValueString();

                $data_monitoring = $this->getMonitoringData($row_i, $sheet);

                $result[] = [
                    "desa" => $desa,
                    "kecamatan" => $kecamatan,
                    "kabupaten" => $kabupaten,
                    "provinsi" => $provinsi,
                    "rt" => $latestDataWilayah['rt'],
                    "rw" => $latestDataWilayah['rw'],
                    "dusun" => $latestDataWilayah['dusun'],
                    "NOKK_PP" => $NOKK_PP,
                    "nama_kepala_keluarga" => $namaKepalaKeluarga,
                    "nama_istri" => $namaIstri,
                    "punya_baduta" => $punyaBaduta,
                    "punya_balita" => $punyaBalita,
                    "pendidikan_istri" => $pendidikanIstri,
                    "asi_eksklusif" => $asiEksklusif == "V",
                    "status_keluarga" => $statusKeluarga,
                    "PUS" => $PUS,
                    "pus_hamil" => $PUSHamil,
                    "punya_sumber_air_layak" => $punyaSumberAirLayak,
                    "punya_jamban_layak" => $punyaJambanLayak,
                    "terlalu_muda" => $terlaluMuda,
                    "terlalu_tua" => $terlaluTua,
                    "terlalu_dekat" => $terlaluDekat,
                    "terlalu_banyak_anak" => $terlaluBanyakAnak,
                    "peserta_KB" => $pesertaKB,
                    "beresiko" => $beresiko,
                    "tingkat_kesejahteraan" => $tingkatKesejahteraan,
                    "jenis_pendampingan" => $jenis_pendampingan,
                    "nama_baduta" => $namaBaduta,
                    "nama_balita" => $namaBalita,
                    "tanggal_lahir" => $tanggalLahir,
                    "data_monitoring" => $data_monitoring
                ];

                $hasNextValue = $this->hasNextValue($row_i, $sheet, 1);
            }
        });

        // dd($result[5]);

        $periode = Periode::where("tahun", "2024")->first("id")->id;
        dispatch(new ImportDataMonitoringJob($result, $periode, Auth::id()));

        Artisan::call('queue:work', [
            '--queue' => 'import',
            '--stop-when-empty' => true,
        ]);

        return ResponseFormatter::success("Proses import berhasil di tambahkan , proses akan berjalan di background, silahkan melakukan pengecekan secara berkala");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PendampinganBalita $pendampingan)
    {
        return response()->json([
            "balita_id" => [
                "value" => $pendampingan->balita_id,
                "label" => $pendampingan->balita->nama_lengkap
            ],
            "tinggi_badan" => number_format($pendampingan->tinggi_badan, 1),
            ...collect($pendampingan)->except(["balita_id", "balita", "tinggi_badan"])->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePendampinganBalitaRequest $request, PendampinganBalita $pendampingan)
    {
        try {
            $pendampingan->update($request->validated());
            return ResponseFormatter::success("Pendampingan berhasil diperbarui", $pendampingan);
        } catch (\Throwable $th) {
            return ResponseFormatter::error("Gagal memperbarui data pendampingan, server error", 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PendampinganBalita $pendampingan)
    {
        try {
            $pendampingan->deleteOrFail();
            return ResponseFormatter::success("Pendampingan berhasil dihapus");
        } catch (\Throwable $th) {
            return ResponseFormatter::error("Gagal menghapus data pendampingan, server error", 500);
        }
    }


    private function isEmptySheet(Worksheet $sheet): bool
    {
        $cell = $sheet->getCell('C1');
        return $cell->getValue() == null;
    }

    private function isSeparator(int $row_index, Worksheet $sheet): bool
    {
        $cell = $sheet->getCell('A' . $row_index);
        return $cell->getValue() == "RT :";
    }

    private function hasNextValue(int $row_index, Worksheet $sheet, int $tolerance  = 5): bool
    {
        if ($sheet->getCell('A' .   $row_index + 1)->getValue() || $sheet->getCell('B' .   $row_index + 1)->getValue()) {
            return true;
        }
        return false;
    }

    private function checkIsSheetExist(string $sheetName, Collection $sheets): bool
    {
        $found = $sheets->first(function ($sheet) use ($sheetName) {
            return ltrim($sheet) == ltrim($sheetName);
        });

        return $found !== null;
    }

    private function getMonitoringData(int $row_i, Worksheet $sheet)
    {
        $data = [];
        $col = 'BR';
        $lastMonthName = null;
        for ($i = 0; true; $i++) {
            if ($i % 4 == 0) {
                $lastMonthName = strtolower($sheet->getCell($col . 12)->getValue());
                if ($lastMonthName == null) {
                    break;
                }
            }
            $key = $sheet->getCell($col . 13)->getValue();
            $value = $sheet->getCell($col . $row_i)->getValue();
            if (str_replace(" ", "_", strtolower($key) == "pendampingan")) {
                $data[$lastMonthName][str_replace(" ", "_", strtolower($key))] = $value == "V";
            } else {
                $data[$lastMonthName][str_replace(" ", "_", strtolower($key))] = $value;
            }
            $col++;
        }

        return $data;
    }
}
