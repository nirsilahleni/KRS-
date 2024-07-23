<?php

namespace App\DataTables\Krs;

use App\Models\Krs\PendataanKr;
use App\Models\Krs\PendataanKrs;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PendataanKrsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                return view('pages.admin.krs.pendataan.pendataan-krs.partials.table-action', compact('row'));
            })
            ->editColumn('punya_baduta', function ($row) {
                return $this->generateCheckList($row->punya_baduta);
            })
            ->editColumn('punya_balita', function ($row) {
                return $this->generateCheckList($row->punya_balita);
            })
            ->editColumn('asi_eksklusif', function ($row) {
                return $this->generateCheckList($row->asi_eksklusif);
            })
            ->editColumn('status_pasangan_usia_subur', function ($row) {
                return $this->generateCheckList($row->status_pasangan_usia_subur);
            })
            ->editColumn('ada_ibu_hamil', function ($row) {
                return $this->generateCheckList($row->ada_ibu_hamil);
            })
            ->editColumn('terlalu_muda', function ($row) {
                return $this->generateCheckList($row->terlalu_muda);
            })
            ->editColumn('terlalu_tua', function ($row) {
                return $this->generateCheckList($row->terlalu_tua);
            })
            ->editColumn('terlalu_dekat', function ($row) {
                return $this->generateCheckList($row->terlalu_dekat);
            })
            ->editColumn("status_krs", function ($row) {
                if ($row->status_krs == 'beresiko') {
                    return '<span class="badge bg-danger">Beresiko</span>';
                }
                return '<span class="badge bg-success">Tidak Beresiko</span>';
            })
            ->editColumn('terlalu_banyak_anak', function ($row) {
                return $this->generateCheckList($row->terlalu_banyak_anak);
            })
            ->rawColumns([
                "punya_baduta",
                "punya_balita",
                "asi_eksklusif",
                "status_pasangan_usia_subur",
                "ada_ibu_hamil", "terlalu_muda",
                "terlalu_tua",
                "terlalu_dekat",
                "status_krs",
                "terlalu_banyak_anak"
            ])
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PendataanKrs $model): QueryBuilder
    {
        $params = request()->only([
            'kepala_keluarga_id',
            'tempat_buang_air_id',
            'sumber_air_minum_id',
            'kb_modern_id',
            'tingkat_kesejahteraan_id',
            'status_krs',
            'punya_baduta',
            'punya_balita',
            'status_pasangan_usia_subur',
            'ada_ibu_hamil',
            'terlalu_muda',
            'terlalu_tua',
            'terlalu_dekat',
            'terlalu_banyak_anak',
            'ada_anggota_keluarga_menikah_tahun_ini',
            'asi_ekslusif',
            'status_krs'
        ]);
        return $model->newQuery()
        ->when(!empty($params), function($query) use($params){
            foreach($params as $key => $value){
                if($value && gettype($value) != 'array'){
                    $query->where($key, $value);
                }else if($value && gettype($value) == 'array'){
                    $query->where($key, 'ya');
                }

            }
        })->with(['kepala_keluarga', 'balita', 'tingkat_kesejahteraan']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pendataankrs-table')
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
                'table align-middle table-row-dashed gy-5 dataTable no-footer text-gray-600 fw-semibold',
            )
            ->responsive(true)
            ->setTableHeadClass('text-start text-muted fw-bold text-uppercase gs-0')
            // ->orderBy(2)
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
                ->title("No")
                ->width(20)
                ->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make("kepala_keluarga.nama_lengkap")->title("Nama Kepala Keluarga"),
            // Column::make("sumber_air.nama"),
            // Column::make("jenis_kb.jenis_kb"),
            Column::make("punya_baduta"),
            // Column::make("asi_ekslusif"),
            Column::make("punya_balita"),
            Column::make("status_pasangan_usia_subur")->title("termasuk PUS"),
            // Column::make("ada_ibu_hamil")->title("Ada Bumil"),
            Column::make("terlalu_muda"),
            Column::make("terlalu_tua"),
            Column::make("terlalu_dekat"),
            Column::make("terlalu_banyak_anak"),
            // Column::make("ada_anggota_keluarga_menikah_tahun_ini"),
            Column::make("status_krs"),
        ];
    }

    private function generateCheckList($data)
    {
        if ($data == 'ya') {
            return '<i class="fal fa-check fs-5 text-success"></i>';
        } else {
            return '<i class="fal fa-times fs-5 text-danger"></i>';
        }
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PendataanKrs_' . date('YmdHis');
    }
}
