<?php

namespace App\DataTables\Master;

use App\Models\Master\Posyandu;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PosyanduDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('aksi', 'posyandu.action')
            ->addColumn('aksi', function (Posyandu $row) {
                return view('pages.admin.master.posyandu.action', ['posyandu' => $row]);
            })
            ->rawColumns(['aksi'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Posyandu $model): QueryBuilder
    {
        return $model->newQuery()
            ->with(['kecamatan', 'kelurahan']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('posyandu-table')
            ->columns($this->getColumns())
            ->minifiedAjax(script: "
                        data._token = '" . csrf_token() . "';
                        data._p = 'POST';
                    ")
            ->addTableClass('table align-middle table-row-dashed  gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold  text-uppercase gs-0')
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
            Column::computed('aksi')
                ->exportable(false)
                ->printable(false)
                ->width(60),
            Column::make('nama_posyandu')->title('Nama Posyandu'),
            Column::make('nomor_hp')->title('Kontak'),
            Column::make('email')->title('Email'),
            Column::make('kecamatan')
                ->title('Kecamatan')
                ->data('kecamatan.nama_kecamatan'),
            Column::make('kelurahan')
                ->title('Kelurahan')
                ->data('kelurahan.nama_kelurahan'),
            Column::make('rt')->title('RT'),
            Column::make('rw')->title('RW'),
            Column::make('alamat')->title('Alamat'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Posyandu_' . date('YmdHis');
    }
}
