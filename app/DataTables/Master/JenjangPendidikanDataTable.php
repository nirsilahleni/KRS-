<?php

namespace App\DataTables\Master;

use App\Models\Master\JenjangPendidikan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class JenjangPendidikanDataTable extends DataTable
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
            ->addColumn('aksi', function (JenjangPendidikan $row) {
                return view('pages.admin.master.jenjang-pendidikan.action', ['jenjangPendidikan' => $row]);
            })
            ->rawColumns(['aksi'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(JenjangPendidikan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('jenjangpendidikan-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->setTableHeadClass('text-start text-muted fw-bold text-uppercase gs-0')
            ->orderBy(1)
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
            Column::make('kode')->title('kode')
                ->addClass('text-center'),
            Column::make('nama_jenjang')->title('nama_jenjang')
                ->addClass('text-center'),
            Column::make('keterangan')->title('keterangan')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Jenjangpendidikan_' . date('YmdHis');
    }
}
