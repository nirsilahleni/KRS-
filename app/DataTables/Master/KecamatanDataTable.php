<?php

namespace App\DataTables\Master;

use App\Models\Master\Kecamatan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KecamatanDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('aksi', function (Kecamatan $row) {
                return view('pages.admin.master.kecamatan.action', ['kecamatan' => $row]);
            })
            ->editColumn('updated_at', function (Kecamatan $kecamatan) {
                return view('components.table-timestamp', [
                    'date' => formatDateFromDatabase($kecamatan->updated_at)
                ]);
            })
            ->rawColumns(['aksi'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Kecamatan $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('kode_kecamatan');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('kecamatan-table')
            ->columns($this->getColumns())
            ->setTableHeadClass('text-start text-muted fw-bold text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallbackWithLivewire(file_get_contents(public_path('assets/js/dataTables/drawCallback.js')))
            ->select(false)
            ->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('No.')
                ->addClass('text-center'),
            Column::computed('aksi')
                ->exportable(false)
                ->printable(false)
                ->width(160)
                ->addClass('text-center'),
            Column::make('kode_kecamatan')->title('Kode')
                ->addClass('text-center'),
            Column::make('nama_kecamatan')->title('Nama')
                ->addClass('text-center'),
            Column::make('keterangan')->title('Keterangan')
                ->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Kecamatan_' . date('YmdHis');
    }
}
