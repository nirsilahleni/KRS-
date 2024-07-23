<?php

namespace App\DataTables\Krs;

use App\Models\Balitum;
use App\Models\Krs\Balita;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BalitaDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Balita $row) {
                return view('pages.admin.krs.balita.partials.table-action', compact('row'));
            })
            ->editColumn('nik', function (Balita $row) {
                return $row->nik ?? '_';
            })
            ->editColumn('tempat_lahir', function (Balita $row) {
                return $row->tempat_lahir . ', ' . Carbon::parse($row->tanggal_lahir)->format('d-m-Y');
            })
            ->editColumn('tinggi_badan', function (Balita $row) {
                return $row->tinggi_badan . ' cm';
            })
            ->editColumn('berat_badan', function (Balita $row) {
                return $row->berat_badan . ' kg';
            })
            ->editColumn('perlu_pendampingan', function (Balita $row) {
                return '<span class="badge bg-' . ($row->perlu_pendampingan == 'Y' ? 'success' : 'danger') . '">' . ($row->perlu_pendampingan == 'Y' ? 'Diperlukan' : 'Tidak Diperlukan') . '</span>';
            })

            ->setRowId('id')
            ->rawColumns(['action', 'perlu_pendampingan'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Balita $model): QueryBuilder
    {
        $params = request()->only(["kepala_keluarga_id", "jenis_kelamin", "perlu_pendampingan"]);
        $kecamatan_id = request()->get('kecamatan_id');
        $kelurahan_id = request()->get('kelurahan_id');
        $rt = request()->get('rt');
        $rw = request()->get('rw');

        return $model->newQuery()->with(['kepala_keluarga.kecamatan','kepala_keluarga.kelurahan'])->when(!empty($params), function (QueryBuilder $q) use ($params) {
            foreach ($params as $key => $value) {
                if ($value) {
                    $q->where($key, $value);
                }
            }
        })->when($kecamatan_id, function ($query, $kecamatan_id) {
            return $query->whereRelation('kepala_keluarga', function ($q) use ($kecamatan_id) {
                $q->where('kecamatan_id', $kecamatan_id);
            });
        })->when($kelurahan_id, function ($query, $kelurahan_id) {
            return $query->whereRelation('kepala_keluarga', function ($q) use ($kelurahan_id) {
                $q->where('kelurahan_id', $kelurahan_id);
            });
        })->when($rt, function ($query, $rt) {
            return $query->whereRelation('kepala_keluarga', function ($q) use ($rt) {
                $q->where('rt', $rt)->orWhere('rt', '0' . $rt);
            });
        })->when($rw, function ($query, $rw) {
            return $query->whereRelation('kepala_keluarga', function ($q) use ($rw) {
                $q->where('rw', $rw);
            });
        })->latest('balita.created_at')->latest('balita.updated_at');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('balita-table')
            ->columns($this->getColumns())
            ->minifiedAjax(
                script: "
                data._token = '" . csrf_token() . "';
                data._p = 'POST';",
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
            Column::make('kepala_keluarga.nama_lengkap')->title('Nama kepala keluarga'),
            Column::make('nik'),
            Column::make('nama_lengkap'),
            Column::make('tempat_lahir')->title("Tempat, tanggal lahir"),
            Column::make('kepala_keluarga.kecamatan.nama_kecamatan')
            ->title('Kecamatan'),
            Column::make('kepala_keluarga.kelurahan.nama_kelurahan')
            ->title('Kelurahan'),
            Column::make('jenis_kelamin'),
            Column::make('tinggi_badan'),
            Column::make('berat_badan'),
            Column::make('perlu_pendampingan')->title('Status pendampingan'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Balita_' . date('YmdHis');
    }
}
