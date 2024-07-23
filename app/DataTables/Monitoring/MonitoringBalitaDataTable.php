<?php

namespace App\DataTables\Monitoring;

use App\Models\Krs\Balita;
use App\Models\Master\Periode;
use App\Models\Monitoring\PendampinganBalita;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

use function PHPUnit\Framework\matches;

class MonitoringBalitaDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (PendampinganBalita $row) {
                return view('pages.admin.monitoring.balita.partials.table-action', compact('row'));
            })
            ->editColumn('tinggi_badan', fn ($row) => "$row->tinggi_badan cm")
            ->editColumn('berat_badan', fn ($row) => "$row->berat_badan kg")
            ->editColumn('bulan', function ($row) {
                \Carbon\Carbon::setLocale('id');
                return \Carbon\Carbon::create()->month($row->bulan)->monthName;
            })
            ->editColumn('tanggal_pendampingan', function ($row) {
                Carbon::setLocale('id');
                if(!$row->tanggal_pendampingan) return "_";
                return Carbon::parse($row->tanggal_pendampingan)->translatedFormat('d F Y');
            })
            ->editColumn('status_berat_badan', function ($row) {
                $color = match ($row->status_berat_badan) {
                    "Berat badan sangat kurang (severly underweight)" => "danger",
                    "Berat badan kurang (underweight)" => "warning",
                    "Berat badan normal" => "success",
                    "Berat badan lebih (overweight)" => "danger",
                    "Belum ditentukan" => "secondary"
                };
                return "<span class='badge bg-$color'>$row->status_berat_badan</span>";
            })
            ->editColumn('status_tinggi_badan', function ($row) {
                $color = match ($row->status_tinggi_badan) {
                    "Tinggi badan sangat pendek (severly stunted)" => "danger",
                    "Tinggi badan pendek (stunted)" => "warning",
                    "Tinggi badan normal" => "success",
                    "Tinggi badan lebih (tall)" => "info",
                    "Belum ditentukan" => "secondary"
                };
                return "<span class='badge bg-$color'>$row->status_tinggi_badan</span>";
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'status_berat_badan', 'status_tinggi_badan'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PendampinganBalita $model): QueryBuilder
    {
        $params = request()->only(["balita_id", "periode_id", "bulan", "jenis_pendampingan", "status_berat_badan", "status_tinggi_badan", "tanggal_pendampingan"]);
        $kecamatan_id = request()->get('kecamatan_id');
        $kelurahan_id = request()->get('kelurahan_id');
        $rt = request()->get('rt');
        $rw = request()->get('rw');

        return $model->newQuery()->with(["balita", "periode"])->when(!empty($params), function (QueryBuilder $q) use ($params) {
            foreach ($params as $key => $value) {
                if ($value) {
                    $q->where($key, $value);
                }
            }
        })
            ->when($kecamatan_id, function ($query, $kecamatan_id) {
                return $query->whereRelation('balita.kepala_keluarga', function ($q) use ($kecamatan_id) {
                    $q->where('kecamatan_id', $kecamatan_id);
                });
            })->when($kelurahan_id, function ($query, $kelurahan_id) {
                return $query->whereRelation('balita.kepala_keluarga', function ($q) use ($kelurahan_id) {
                    $q->where('kelurahan_id', $kelurahan_id);
                });
            })->when($rt, function ($query, $rt) {
                return $query->whereRelation('balita.kepala_keluarga', function ($q) use ($rt) {
                    $q->where('rt', $rt)->orWhere('rt', '0' . $rt);
                });
            })->when($rw, function ($query, $rw) {
                return $query->whereRelation('balita.kepala_keluarga', function ($q) use ($rw) {
                    $q->where('rw', $rw);
                });
            })->latest('pendampingan_balita.created_at')->latest('pendampingan_balita.updated_at');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('monitoring-balita-table')
            ->columns($this->getColumns())
            ->minifiedAjax(
                script: "
                data._token = '" . csrf_token() . "';
                data._p = 'POST'
            ;",
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
            Column::computed("DT_RowIndex")
                ->title('No'),
            Column::computed('action')
                ->title('Aksi')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('balita.nama_lengkap')
                ->title('Nama balita'),
            Column::make('periode.tahun')
                ->title('Periode'),
            Column::make('bulan'),
            Column::make("jenis_pendampingan"),
            Column::make("tanggal_pendampingan"),
            Column::make("berat_badan"),
            Column::make("tinggi_badan"),
            Column::make("status_berat_badan"),
            Column::make("status_tinggi_badan")
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'MonitoringBalita_' . date('YmdHis');
    }
}
