<?php

namespace App\DataTables\Monitoring;

use App\Models\Monitoring\PendampinganIbuHamil;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class IbuHamilDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (PendampinganIbuHamil $row) {
                return view('pages.admin.monitoring.ibu-hamil.partials.table-action', compact('row'));
            })
            ->editColumn('tanggal_pendampingan', function (PendampinganIbuHamil $row) {
                return formatDateFromDatabase($row->tanggal_pendampingan, 'd F Y')['formatted'];
            })
            ->editColumn('bulan', function (PendampinganIbuHamil $row) {
                switch ($row->bulan) {
                    case 1:
                        return 'Januari';
                    case 2:
                        return 'Februari';
                    case 3:
                        return 'Maret';
                    case 4:
                        return 'April';
                    case 5:
                        return 'Mei';
                    case 6:
                        return 'Juni';
                    case 7:
                        return 'Juli';
                    case 8:
                        return 'Agustus';
                    case 9:
                        return 'September';
                    case 10:
                        return 'Oktober';
                    case 11:
                        return 'November';
                    default:
                        return 'Desember';
                }
            })
            ->editColumn('usia_kehamilan', function (PendampinganIbuHamil $row) {
                return $row->usia_kehamilan . ' Bulan';
            })
            ->editColumn('status_kehamilan', function (PendampinganIbuHamil $row) {
                switch ($row->status_kehamilan) {
                    case 'N':
                        return <<<HTML
                            <span class="badge text-black " style="background:lightgray;">Normal</span>
                            HTML;

                    case 'Risti':
                        return <<<HTML
                            <span class="badge text-white bg-warning" >Resiko Tinggi</span>
                            HTML;
                    default:
                        return <<<HTML
                            <span class="badge text-white bg-danger" >Kekurangan Energi Kronis</span>
                            HTML;
                }
            })
            ->editColumn('pemeriksaan_kehamilan', function (PendampinganIbuHamil $row) {
                return '<span class="badge bg-' . ($row->pemeriksaan_kehamilan == "Y" ? "success" : 'danger') . '">' . ($row->pemeriksaan_kehamilan == "Y" ? 'Ya' : 'Tidak') . '</span>';
            })
            ->editColumn('pemeriksaan_nifas', function (PendampinganIbuHamil $row) {
                return '<span class="badge bg-' . ($row->pemeriksaan_nifas == "Y" ? "success" : 'danger') . '">' . ($row->pemeriksaan_nifas == "Y" ? 'Ya' : 'Tidak') . '</span>';
            })
            ->editColumn('konsumsi_pil_fe', function (PendampinganIbuHamil $row) {
                return '<span class="badge bg-' . ($row->konsumsi_pil_fe == "Y" ? "success" : 'danger') . '">' . ($row->konsumsi_pil_fe == "Y" ? 'Ya' : 'Tidak') . '</span>';
            })
            ->editColumn('konseling_gizi', function (PendampinganIbuHamil $row) {
                return '<span class="badge bg-' . ($row->konseling_gizi == "Y" ? "success" : 'danger') . '">' . ($row->konseling_gizi == "Y" ? 'Ya' : 'Tidak') . '</span>';
            })
            ->editColumn('kunjungan_rumah', function (PendampinganIbuHamil $row) {
                return '<span class="badge bg-' . ($row->kunjungan_rumah == "Y" ? "success" : 'danger') . '">' . ($row->kunjungan_rumah == "Y" ? 'Ya' : 'Tidak') . '</span>';
            })
            ->editColumn('akses_air_bersih', function (PendampinganIbuHamil $row) {
                return '<span class="badge bg-' . ($row->akses_air_bersih == "Y" ? "success" : 'danger') . '">' . ($row->akses_air_bersih == "Y" ? 'Ya' : 'Tidak') . '</span>';
            })
            ->editColumn('ada_jamban', function (PendampinganIbuHamil $row) {
                return '<span class="badge bg-' . ($row->ada_jamban == "Y" ? "success" : 'danger') . '">' . ($row->ada_jamban == "Y" ? 'Ya' : 'Tidak') . '</span>';
            })
            ->editColumn('jaminan_kesehatan', function (PendampinganIbuHamil $row) {
                return '<span class="badge bg-' . ($row->jaminan_kesehatan == "Y" ? "success" : 'danger') . '">' . ($row->jaminan_kesehatan == "Y" ? 'Ya' : 'Tidak') . '</span>';
            })
            ->setRowId('id')
            ->rawColumns(['action', 'tanggal_pendampingan', 'bulan', 'usia_kehamilan', 'status_kehamilan', 'pemeriksaan_kehamilan', 'pemeriksaan_nifas', 'konsumsi_pil_fe', 'konseling_gizi', 'kunjungan_rumah', 'akses_air_bersih', 'ada_jamban', 'jaminan_kesehatan'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PendampinganIbuHamil $model): QueryBuilder
    {
        $params = request()->only(["posyandu_id", "periode_id", "bulan"]);
        $q = $model->newQuery()->with(['posyandu', 'periode', 'pendataan_kia', 'pendataan_kia.kepala_keluarga_anggota']);

        $q->when(!empty($params), function (QueryBuilder $q) use ($params) {
            foreach ($params as $key => $value) {
                if ($value) {
                    $q->where($key, $value);
                }
            }
        });

        return $q;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('ibuhamil-table')
            ->columns($this->getColumns())
            ->minifiedAjax(
                script: "
                data._token = '" . csrf_token() . "';
                data._p = 'POST';
                data.periode_id = $('#periode_field4').val();
                data.bulan = $('#bulan_field4').val();
                data.balita_id = $('#posyandu_field4').val();
                ",
            )
            ->addTableClass(
                'table align-middle table-row-dashed gy-5 dataTable no-footer text-gray-600
                fw-semibold',
            )
            ->setTableHeadClass('text-start text-muted fw-bold text-uppercase gs-0')
            ->orderBy(4)
            ->responsive(true)
            ->drawCallbackWithLivewire(file_get_contents(public_path('assets/js/dataTables/drawCallback.js')))
            ->select(false);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('No')
                ->width(20)
                ->addClass('text-center')
                ->orderable(false)
                ->searchable(false),
            Column::computed('action')
                ->title('Aksi')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('pendataan_kia.nomor_kia')->title('Nomor KIA'),
            Column::make('pendataan_kia.kepala_keluarga_anggota.nama_lengkap')->title('Nama Ibu Hamil'),
            Column::make('tanggal_pendampingan')->title('Tanggal Pendampingan'),
            Column::make('periode.tahun')->title('Periode'),
            Column::make('bulan')->title('Bulan'),
            Column::make('posyandu.nama_posyandu')->title('Posyandu'),
            Column::make('usia_kehamilan')->title('Usia Kehamilan'),
            Column::make('status_kehamilan')->title('Status Kehamilan'),
            Column::make('pemeriksaan_kehamilan')->title('Pemeriksaan Kehamilan'),
            Column::make('pemeriksaan_nifas')->title('Pemeriksaan Nifas'),
            Column::make('konsumsi_pil_fe')->title('Konsumsi Pil Fe'),
            Column::make('konseling_gizi')->title('Konseling Gizi'),
            Column::make('kunjungan_rumah')->title('Kunjungan Rumah'),
            Column::make('akses_air_bersih')->title('Akses Air Bersih'),
            Column::make('ada_jamban')->title('Ada Jamban'),
            Column::make('jaminan_kesehatan')->title('Jaminan Kesehatan'),
            Column::make('catatan')->title('Catatan'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'IbuHamil_' . date('YmdHis');
    }
}
