<?php

namespace App\DataTables\Master;

use App\Models\Master\Kelurahan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KelurahanDataTable extends DataTable
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
            ->addColumn('aksi', function (Kelurahan $row) {
                return view('pages.admin.master.kelurahan.action', ['kelurahan' => $row]);
            })
            ->editColumn('updated_at', function (Kelurahan $kelurahan) {
                return view('components.table-timestamp', [
                    'date' => formatDateFromDatabase($kelurahan->updated_at)
                ]);
            })
            ->filterColumn('nama_kecamatan', function ($query, $keyword) {
                $query->whereRaw("ref_kecamatan.nama_kecamatan like ?", ["%{$keyword}%"]);
            })
            ->rawColumns(['aksi'])
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Kelurahan $model): QueryBuilder
    {
        return $model->newQuery()
            ->join('ref_kecamatan', 'ref_kelurahan.kecamatan_id', '=', 'ref_kecamatan.id')
            ->select('ref_kelurahan.*', 'ref_kecamatan.nama_kecamatan')
            ->orderBy('ref_kelurahan.kode_kelurahan');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('kelurahan-table')
            ->columns($this->getColumns())
            ->setTableHeadClass('text-start text-muted fw-bold text-uppercase gs-0')
            ->orderBy(3)
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
            Column::make('nama_kecamatan')->title('Kecamatan')
                ->addClass('text-center'),
            Column::make('kode_kelurahan')->title('Kode Kelurahan')
                ->addClass('text-center'),
            Column::make('nama_kelurahan')->title('Nama Kelurahan')
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
        return 'Kelurahan_' . date('YmdHis');
    }
}
