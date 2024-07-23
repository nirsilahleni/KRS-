<?php

namespace App\DataTables\Krs;

use App\Models\Krs\KepalaKeluarga;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DataKepalaKeluargaDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('aksi', 'role.action')
            ->addIndexColumn()
            ->addColumn('action', function (KepalaKeluarga $val) {
                return view('pages.admin.krs.keluarga.action', ['kk' => $val]);
            })
            ->addColumn('jumlah_anggota', function (KepalaKeluarga $row) {
                return $row->kepala_keluarga_anggota()->count();
            })
            ->rawColumns(['aksi'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(KepalaKeluarga $model): QueryBuilder
    {
        $params = request()->only(["kecamatan_id", "kelurahan_id", "rt", "rw"]);
        return $model->newQuery()
            ->when(count($params) > 0, function ($query) use ($params) {
                foreach ($params as $key => $val) {
                    if ($val != null) {
                        $query->where($key, $val);
                    }
                }
            })
            ->latest('created_at')->latest('updated_at');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('datakepalakeluarga-table')
            ->columns($this->getColumns())
            ->minifiedAjax(
                script: "
                    data._token = '" .
                    csrf_token() .
                    "';
                    data._p = 'POST';
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
            Column::computed('DT_RowIndex')->title('No.')->width(30),
            Column::computed('action')->title('Aksi')->exportable(false)->printable(false)->width(60)->addClass('text-center'),
            Column::make('nomor_kk'),
            Column::make('nik'),
            Column::make('nama_lengkap'),
            Column::computed('jumlah_anggota')->title('Jumlah Anggota'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'DataKepalaKeluarga_' . date('YmdHis');
    }
}
