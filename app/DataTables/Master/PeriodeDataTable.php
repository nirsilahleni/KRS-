<?php

namespace App\DataTables\Master;

use App\Models\Master\Periode;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PeriodeDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('aksi', 'periode.action')
            ->addIndexColumn()
            ->addColumn('aksi', function (Periode $row) {
                return view('pages.admin.master.periode.action', ['periode' => $row]);
            })
            ->editColumn('is_active', function (Periode $periode) {
                return $periode->is_active ? 'Aktif' : 'Tidak Aktif';
            })
            ->editColumn('created_at', function (Periode $periode) {
                return view('components.table-timestamp', [
                    'date' => formatDateFromDatabase($periode->created_at)
                ]);
            })
            ->editColumn('updated_at', function (Periode $periode) {
                return view('components.table-timestamp', [
                    'date' => formatDateFromDatabase($periode->updated_at)
                ]);
            })
            ->editColumn('periode', function (Periode $periode) {
                $formattedMulai = Carbon::parse($periode->tanggal_mulai)->locale('id')->translatedFormat('d F Y');
                $formattedSelesai = Carbon::parse($periode->tanggal_selesai)->locale('id')->translatedFormat('d F Y');
                return $formattedMulai . ' - ' . $formattedSelesai;
            })
            ->rawColumns(['aksi', 'periode'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Periode $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('is_active', 'asc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('periode-table')
            ->columns($this->getColumns())
            ->minifiedAjax(script: "
                        data._token = '" . csrf_token() . "';
                        data._p = 'POST';
                    ")
            ->addTableClass('table align-middle table-row-dashed  gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold  text-uppercase gs-0')
            ->drawCallbackWithLivewire(file_get_contents(public_path('/assets/js/dataTables/drawCallback.js')))
            ->select(false)
            ->buttons([])
            ->orders([[6, 'desc']]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('No.')
                ->width(20),
            Column::computed('aksi')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('tahun'),
            Column::make('periode')->searchable(false)->orderable(false),
            Column::make('is_active')->title('Status Aktif')->searchable(false)->orderable(false),
            Column::make('created_at')->title('Dibuat Pada')->searchable(false)->orderable(false),
            Column::make('updated_at')->title('Diubah Pada')->searchable(false)->orderable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Periode_' . date('YmdHis');
    }
}
