<?php

namespace App\DataTables\Krs;

use App\Models\Krs\KepalaKeluargaAnggota;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class KepalaKeluargaAnggotaDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    protected $id;

    public function setKepalaKeluargaId($id)
    {
        $this->id = $id;
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function (KepalaKeluargaAnggota $val) {
                return view('pages.admin.krs.keluarga.anggota.action', ['anggota' => $val]);
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(KepalaKeluargaAnggota $model): QueryBuilder
    {
        $query = $model->newQuery();
        $query->where('kepala_keluarga_id', $this->id);
        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('kepalakeluargaanggota-table')
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
            ->responsive(true)
            ->setTableHeadClass('text-start text-muted fw-bold text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallbackWithLivewire(file_get_contents(public_path('assets/js/dataTables/drawCallback.js')))
            ->select(false);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [Column::computed('DT_RowIndex')->title('No.')->width(30),
            Column::computed('action')->exportable(false)->printable(false)->width(60)->addClass('text-center'),
            Column::make('nik'),
            Column::make('nama_lengkap'),
            Column::make('jenis_kelamin')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'KepalaKeluargaAnggota_' . date('YmdHis');
    }
}
