<?php

namespace App\DataTables\Admin;

use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class MenuDataTable
 * @package App\DataTables\Admin
 */
class MenuDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $token = JWTAuth::fromUser(Auth::user());
        $dataTable = new EloquentDataTable($query);
        $dataTable->editColumn('position', function (Menu $menu) use ($token) {
            return '<span class="hidden">' . $menu->position . '</span><input type="hidden" data-id="' . $menu->id . '" class="inputSort" value="' . $menu->position . '"><a href="javascript:void(0)" class="btn btn-success btn-up-ajax" data-url="' . url('api/v1/menus/' . $menu->id) . '" data-token="' . $token . '"><i class="fa fa-arrow-up"></i></a><a href="javascript:void(0)" class="btn btn-success btn-down-ajax" data-url="' . url('api/v1/menus/' . $menu->id) . '" data-token="' . $token . '"><i class="fa fa-arrow-down"></i></a>';
        });
        $dataTable->addColumn('action', 'admin.menus.datatables_actions');
        $dataTable->rawColumns(['position', 'action']);
        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Menu $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Menu $model)
    {
        return $model->selectRaw('*')->orderBy('position')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $buttons = [];
        if (\Entrust::can('menus.create') || \Entrust::hasRole('super-admin')) {
//            $buttons = ['create'];
        }
        $buttons = array_merge($buttons, [
//            'export',
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
                'bPaginate' => false,
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
            'position',
            'name'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'menusdatatable_' . time();
    }
}