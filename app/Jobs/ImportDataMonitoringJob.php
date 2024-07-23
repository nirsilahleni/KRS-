<?php

namespace App\Jobs;

use App\Events\ImportDataCompletedEvent;
use App\Models\Krs\Balita;
use App\Models\Krs\KepalaKeluarga;
use App\Models\Krs\KepalaKeluargaAnggota;
use App\Models\Krs\MonitoringPendampingan;
use App\Models\Krs\PendataanKrs;
use App\Models\Master\Kecamatan;
use App\Models\Master\Kelurahan;
use App\Models\Master\Periode;
use App\Models\Monitoring\PendampinganBalita;
use App\Models\StandarDeviasi;
use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ImportDataMonitoringJob extends ImportDataJob implements ShouldBeUniqueUntilProcessing
{
    /**
     * Create a new job instance.
     */
    public function __construct(array $payload, private string $periode_id, $author)
    {
        parent::__construct($payload, $author);

        $this->afterCommit();
        $this->onQueue("import");
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $success_count = 0;
        $failed_count = 0;

        $bulan_list = ["januari", "februari", "maret", "april", "mei", "juni", "juli", "agustus", "september", "oktober", "november", "desember"];

        foreach ($this->payload as $i => $data) {
            try {
                DB::beginTransaction();
                // insert data kepala keluarga
                if (!$data["nama_kepala_keluarga"]) {
                    $kepala_keluarga = KepalaKeluarga::firstOrCreate([
                        "nama_lengkap" => ucwords(strtolower($data["nama_istri"])),
                        "nik" => $data["nik_istri"] ?? $this->randomizeNik(),
                        "nomor_kk" => $data["NOKK_PP"] ? $this->minify($data["NOKK_PP"]) :  $this->randomizeNoKk(),
                        "alamat" => $this->generateAlamat($data),
                        "provinsi" => $data["provinsi"],
                        "kabupaten" => $data["kabupaten"],
                        "rt" => $data["rt"],
                        "rw" => $data["rw"],
                        "status_keluarga_id" => $data["status_keluarga"] ?? "5",
                        "kecamatan_id" => $this->getKecamatan($data["kecamatan"])["id"],
                        "kelurahan_id" => $this->getKelurahan($data["desa"])["id"],
                        "created_by" => $this->author,
                        "updated_by" => $this->author,
                        "periode_id" => $this->periode_id
                    ]);
                } else {
                    $kepala_keluarga = KepalaKeluarga::firstOrCreate([
                        "nama_lengkap" => ucwords(strtolower($data["nama_kepala_keluarga"])),
                        "nik" => $data["nik_kepala_keluarga"] ?? $this->randomizeNik(),
                        "nomor_kk" => $data["NOKK_PP"] ? $this->minify($data["NOKK_PP"]) : $this->randomizeNoKk(),
                        "alamat" => $this->generateAlamat($data),
                        "provinsi" => $data["provinsi"],
                        "kabupaten" => $data["kabupaten"],
                        "rt" => $data["rt"],
                        "rw" => $data["rw"],
                        "status_keluarga_id" => $data["nama_istri"] ? $data["status_keluarga"] ?? "5" : "1",
                        "kecamatan_id" => $this->getKecamatan($data["kecamatan"])["id"],
                        "kelurahan_id" => $this->getKelurahan($data["desa"])["id"],
                        "created_by" => $this->author,
                        "updated_by" => $this->author,
                        "periode_id" => $this->periode_id
                    ]);

                    // if has istri
                    if ($data["nama_istri"]) {
                        $payload = [
                            "kepala_keluarga_id" => $kepala_keluarga->id,
                            "nama_lengkap" => $data["nama_istri"],
                            "nik" => $data["nik_istri"] ?? $this->randomizeNik(),
                            "status_hubungan_id" => "2",
                            "jenjang_pendidikan_id" => (int)$data["pendidikan_istri"],
                            "created_by" => $this->author,
                            "jenis_kelamin" => "P",
                            "updated_by" => $this->author,
                        ];

                        if (!$data["pendidikan_istri"]) {
                            unset($payload["jenjang_pendidikan_id"]);
                        }
                        KepalaKeluargaAnggota::firstOrCreate($payload);
                    }

                    // insert pendataan krs

                    $inserted_pendataan_krs = PendataanKrs::where([
                        "kepala_keluarga_id" => $kepala_keluarga->id,
                        "periode_id" => $this->periode_id,
                        "sumber_air_minum_id" => $data["punya_sumber_air_layak"] ? "11" : "10",
                        "tempat_buang_air_id" => $data["punya_jamban_layak"] ? "5" : "3",
                        "status_pasangan_usia_subur" => $data["PUS"] ? "ya" : "tidak",
                        "pus_hamil" => $data["pus_hamil"] ? "ya" : "tidak",
                        "punya_baduta" => $data["punya_baduta"] ? "ya" : "tidak",
                        "punya_balita" => $data["punya_balita"] ? "ya" : "tidak",
                        "terlalu_muda" => $data["terlalu_muda"] ? "ya" : "tidak",
                        "asi_eksklusif" => $data["asi_eksklusif"] ? "ya" : "tidak",
                        "terlalu_tua" => $data["terlalu_tua"] ? "ya" : "tidak",
                        "terlalu_dekat" => $data["terlalu_dekat"] ? "ya" : "tidak",
                        "kb_modern_id" => "9",
                        "terlalu_banyak_anak" => $data["terlalu_banyak_anak"] ? "ya" : "tidak",
                        "status_krs" => $data["beresiko"] ? "beresiko" : "tidak beresiko",
                        "tingkat_kesejahteraan" => (int)$data["tingkat_kesejahteraan"] ?? 0,
                        "periode_id" => $this->periode_id,
                    ])->first();

                    if ($inserted_pendataan_krs) {
                        $inserted_pendataan_krs->update([
                            "terlalu_banyak_anak" => Balita::where("kepala_keluarga_id", $kepala_keluarga->id)->count() >= 8 ? "Y" : "N",
                        ]);
                    } else {
                        $inserted_pendataan_krs = PendataanKrs::firstOrCreate([
                            "kepala_keluarga_id" => $kepala_keluarga->id,
                            "periode_id" => $this->periode_id,
                            "sumber_air_minum_id" => $data["punya_sumber_air_layak"] ? "11" : "10",
                            "tempat_buang_air_id" => $data["punya_jamban_layak"] ? "5" : "3",
                            "status_pasangan_usia_subur" => $data["PUS"] ? "ya" : "tidak",
                            "pus_hamil" => $data["pus_hamil"] ? "ya" : "tidak",
                            "punya_baduta" => $data["punya_baduta"] ? "ya" : "tidak",
                            "punya_balita" => $data["punya_balita"] ? "ya" : "tidak",
                            "terlalu_muda" => $data["terlalu_muda"] ? "ya" : "tidak",
                            "asi_eksklusif" => $data["asi_eksklusif"] ? "ya" : "tidak",
                            "terlalu_tua" => $data["terlalu_tua"] ? "ya" : "tidak",
                            "terlalu_dekat" => $data["terlalu_dekat"] ? "ya" : "tidak",
                            "kb_modern_id" => "9",
                            "terlalu_banyak_anak" => $data["terlalu_banyak_anak"] ? "ya" : "tidak",
                            "status_krs" => $data["beresiko"] ? "beresiko" : "tidak beresiko",
                            "tingkat_kesejahteraan" => (int)$data["tingkat_kesejahteraan"] ?? 0,
                            "periode_id" => $this->periode_id,
                            "created_by" => $this->author,
                            "updated_by" => $this->author
                        ]);
                    }
                    MonitoringPendampingan::firstOrCreate([
                        "monitoring_id" => $inserted_pendataan_krs->id,
                        "pendampingan_id" => $data["jenis_pendampingan"] ?? 8,
                    ]);

                    KepalaKeluargaAnggota::firstOrCreate([
                        "kepala_keluarga_id" => $kepala_keluarga->id,
                        "nama_lengkap" => ucwords(strtolower($data["nama_balita"] ?? $data["nama_baduta"])),
                        "status_hubungan_id" => "2",
                        "nik" => $data["nik_balita"] ?? $this->randomizeNik(),
                        "created_by" => $this->author,
                        "jenis_kelamin" => "L",
                        "updated_by" => $this->author,
                    ]);

                    // insert data balita\\

                    if (is_numeric($data["tanggal_lahir"])) {
                        $unixTimestamp = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($data["tanggal_lahir"]);
                        $date = (new DateTime())->setTimestamp($unixTimestamp);
                        $tanggal_lahir = $date->format('Y-m-d');
                    } else {
                        // check separator
                        $separator = strpos($data["tanggal_lahir"], "/") ? "/" : false;

                        if (!$separator) {
                            $separator = strpos($data["tanggal_lahir"], "-") ? "-" : false;
                        }

                        if (!$separator) {
                            $tanggal_lahir = null;
                        } else {
                            $parts = explode($separator, $data["tanggal_lahir"]);

                            if ((int)$parts[1]  > 12) {
                                $tanggal_lahir =  DateTime::createFromFormat('m/d/Y', str_replace($separator, "/", $data["tanggal_lahir"]));
                                if ($tanggal_lahir) {
                                    $tanggal_lahir = $tanggal_lahir->format('Y-m-d');
                                }
                            } else {

                                $tanggal_lahir =  DateTime::createFromFormat('d/m/Y', str_replace($separator, "/", $data["tanggal_lahir"]));
                                if ($tanggal_lahir) {
                                    $tanggal_lahir = $tanggal_lahir->format('Y-m-d');
                                }
                            }
                        }
                    }


                    $payloadBalita = [
                        "nama_lengkap" => ucwords(strtolower($data["nama_balita"] ?? $data["nama_baduta"])),
                        "nik" => $data["nik_balita"] ?? $this->randomizeNik(),
                        "kepala_keluarga_id" => $kepala_keluarga->id,
                        "tinggi_badan" => 0,
                        "berat_badan" => 0,
                        "jenis_kelamin" => "L",
                        "tempat_lahir" => ucfirst(strtolower($data["kabupaten"])),
                        "periode_id" => $this->periode_id,
                    ];

                    if ($tanggal_lahir) {
                        $payloadBalita["tanggal_lahir"] = $tanggal_lahir;
                        $payloadBalita["usia"] = Carbon::parse($tanggal_lahir)->diffInWeeks(Carbon::now());
                    } else {
                        $payloadBalita["usia"] = 0;
                    }
                    $balita = Balita::firstOrCreate($payloadBalita);

                    // insert data monitoring

                    foreach ($data["data_monitoring"] as  $i => $data_monitoring) {
                        try {
                            if (gettype((int) $data_monitoring["usia"]) != "integer") {
                                $umur_bulan = 0;
                            } else {
                                $umur_bulan = floor($data_monitoring['usia'] / 4);
                            }
                            $jenis_kelamin = $balita->jenis_kelamin;
                            $SDTB = StandarDeviasi::where('umur', $umur_bulan)
                                ->where('type', 'TB')
                                ->where('jenis_kelamin', $jenis_kelamin)->first();
                            $SDBB = StandarDeviasi::where('umur', $umur_bulan)
                                ->where('type', 'BB')
                                ->where('jenis_kelamin', $jenis_kelamin)->first();

                            $berat_badan = isset($data_monitoring["berat_badan"]) ? number_format((float)$data_monitoring["berat_badan"], 2) : 0;

                            if (strpos($data_monitoring["tinggi_badan"], ",")) {
                                $data_monitoring["tinggi_badan"] = str_replace(",", ".", $data_monitoring["tinggi_badan"]);
                            }
                            $tinggi_badan = isset($data_monitoring["tinggi_badan"]) ? number_format((float)$data_monitoring["tinggi_badan"], 1) : 0;

                            PendampinganBalita::firstOrCreate([
                                "balita_id" => $balita->id,
                                "tinggi_badan" => $data_monitoring["tinggi_badan"] ?? 0.0,
                                "bulan" => array_search(trim(strtolower($i)), $bulan_list) + 1,
                                "berat_badan" => $berat_badan,
                                "status_berat_badan" => $berat_badan ? zscore($SDBB, $berat_badan) : "Belum ditentukan",
                                "status_tinggi_badan" => $tinggi_badan ? zscore($SDTB, $tinggi_badan) : "Belum ditentukan",
                                "usia" => $data_monitoring["usia"] ?? 0,
                                "created_by" => $this->author,
                                "updated_by" => $this->author,
                                "periode_id" => $this->periode_id
                            ]);
                        } catch (\Throwable $th) {
                        }
                    }
                }
                DB::commit();
                $success_count++;

                // $this->onSuccess();
            } catch (\Throwable $th) {
                DB::rollBack();
                logger()->error($th);
                $failed_count++;
            }
        }
        logger("Success count: $success_count , Failed count: $failed_count");
    }

    private function randomizeNik()
    {
        return \Faker\Factory::create()->unique()->numerify('################');
    }

    private function minify($string)
    {
        return preg_replace('/\s+/', ' ', $string);
    }

    private function randomizeNoKk()
    {
        return "rand_" . \Faker\Factory::create()->unique()->numerify('###########');
    }

    private function generateAlamat($data)
    {
        return sprintf(
            "%s RT.%s RW.%s %s %s %s %s ",
            strtolower($data["dusun"]),
            $data["rt"],
            $data["rw"],
            ucfirst(strtolower($data["desa"])),
            ucfirst(strtolower($data["kecamatan"])),
            ucfirst(strtolower($data["kabupaten"])),
            ucfirst(strtolower($data["provinsi"]))
        );
    }

    private function getKelurahan($nama_kelurahan)
    {
        return Kelurahan::where("nama_kelurahan", ucfirst(strtolower($nama_kelurahan)))->first("id");
    }

    private function getKecamatan($nama_kecamatan)
    {
        return Kecamatan::where("nama_kecamatan", ucfirst(strtolower($nama_kecamatan)))->first("id");
    }

    public function uniqueId()
    {
        return $this->author;
    }
}
