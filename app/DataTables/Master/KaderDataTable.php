<?php

namespace App\DataTables\Master;

use App\Models\Master\Kader;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;


class KaderDataTable extends DataTable
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
            ->addColumn('aksi', function (Kader $row) {
                return view('pages.admin.master.kader.action', ['kader' => $row]);
            })
            ->editColumn('kecamatan_id', function (Kader $kader) {
                return $kader->kecamatan->nama_kecamatan;
            })
            ->editColumn('kelurahan_id', function (Kader $kader) {
                return $kader->kelurahan->nama_kelurahan;
            })
            ->editColumn('posyandu_id', function (Kader $kader) {
                return $kader->posyandu->nama_posyandu;
            })
            ->editColumn('jenis_kelamin', function (Kader $kader) {
                return $kader->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
            })
            ->editColumn('tanggal_lahir', function (Kader $kader) {
                return formatDateFromDatabase($kader->tanggal_lahir, 'd F Y')['formatted'];
            })
            ->rawColumns(['aksi'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Kader $model): QueryBuilder
    {
        return $model->newQuery()
            ->with(['kecamatan', 'kelurahan', 'posyandu']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('kader-table')
            ->columns($this->getColumns())
            ->setTableHeadClass('text-start text-muted fw-bold text-uppercase gs-0')
            ->orderBy(3)
            ->drawCallbackWithLivewire(file_get_contents(public_path('assets/js/dataTables/drawCallback.js')))
            ->select(false)
            ->responsive(true)
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
            Column::make('nama_lengkap')
                ->addClass('text-center'),
            Column::make('nik')
                ->addClass('text-center'),
            Column::make('tempat_lahir')
                ->addClass('text-center'),
            Column::make('tanggal_lahir')
                ->addClass('text-center'),
            Column::make('jenis_kelamin')
                ->addClass('text-center'),
            Column::make('nomor_hp')
                ->addClass('text-center'),
            Column::make('email')
                ->addClass('text-center'),
            Column::make('kecamatan.nama_kecamatan')
                ->addClass('text-center')
                ->title('Kecamatan'),
            Column::make('kelurahan.nama_kelurahan')
                ->addClass('text-center')
                ->title('Kelurahan'),

            Column::make('posyandu.nama_posyandu')
                ->addClass('text-center')
                ->title('Posyandu'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Kader_' . date('YmdHis');
    }
}
