<?php

namespace App\DataTables\Admin;

use App\Helper\Util;
use App\Models\Page;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

/**
 * Class PageDataTable
 * @package App\DataTables\Admin
 */
class PageDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        /**
         * for master detail search uncomment next lines
         */

        $query = $query->with(['translations']);

        $dataTable = new EloquentDataTable($query);

        $dataTable->editColumn('translations.title', function (Page $model) {
            return $model->title;
        });

        $dataTable->editColumn('status', function (Page $model) {
            return '<span class="label label-' . Util::getBoolCss($model->status) . '">' . Util::getBoolText($model->status) . '</span>';
        });
        $dataTable->rawColumns(['status', 'action']);
        return $dataTable->addColumn('action', 'admin.pages.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Page $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Page $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $buttons = [];
        if (\Entrust::can('pages.create') || \Entrust::hasRole('super-admin')) {
            $buttons = ['create'];
        }
        $buttons = array_merge($buttons, [
            //'export',
            'excel',
            'csv',
            'print',
            'reset',
            'reload',
        ]);
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '80px', 'printable' => false])
            ->parameters([
                'dom'     => 'Blfrtip',
                'order'   => [[0, 'desc']],
                'buttons' => $buttons,
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'translations.title' => [
                'searchable' => true,
                'title'      => 'Title'
            ],
            'slug',
            'status'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'pagesdatatable_' . time();
    }
}