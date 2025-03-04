<?php

namespace App\DataTables\Cms;

use App\Models\Cms\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class NewsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        return (new EloquentDataTable($query))
            ->addColumn('aksi', 'news.action')
            ->addIndexColumn()
            ->addColumn('aksi', function (News $row) {
                return view('pages.admin.cms.news.action', ['news' => $row]);
            })
            ->editColumn('description', function (News $news) {
                return substr($news->description, 0, 50) . '...';
            })
            ->editColumn('created_by', function (News $news) {
                return $news->author->name;
            })
            ->editColumn('updated_by', function (News $news) {
                return $news->mutator?->name;
            })
            ->editColumn('created_at', function (News $news) {
                return view('components.table-timestamp', [
                    'date' => formatDateFromDatabase($news->created_at),
                    'user' => $news->createddBy
                ]);
            })
            ->editColumn('updated_at', function (News $news) {
                return view('components.table-timestamp', [
                    'date' => formatDateFromDatabase($news->updated_at),
                    'user' => $news->updatedBy
                ]);
            })
            ->rawColumns(['aksi'])
            ->setRowId('id');
    }

    public function query(News $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('news-table')
            ->columns($this->getColumns())
            ->minifiedAjax(script: "
                        data._token = '" . csrf_token() . "';
                        data._p = 'POST';
                    ")
            ->addTableClass('table align-middle table-row-dashed  gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold  text-uppercase gs-0')
            ->drawCallbackWithLivewire(file_get_contents(public_path('assets/js/dataTables/drawCallback.js')))
            ->orderBy(2)
            ->select(false)
            ->buttons([]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('No.')
                ->width(20)
                ->addClass('text-center'),
            Column::computed('aksi')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('title')->title('Judul Berita')->addClass('text-center'),
            Column::make('news_kategori_id')->title('Kategori')->addClass('text-center'),
            // Column::make('description')->title('Deskripsi')->addClass('text-center'),
            Column::make('created_at')->title('Dibuat pada')->addClass('text-center'),
            Column::make('updated_at')->title('Terakhir Diubah')->addClass('text-center'),
            Column::make('created_by')->title('Dibuat oleh')->addClass('text-center'),
            Column::make('updated_by')->title('Diedit oleh')->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'News_' . date('YmdHis');
    }
}
