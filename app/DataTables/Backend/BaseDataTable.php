<?php

namespace App\DataTables\Backend;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

class BaseDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $queries = (new EloquentDataTable($query))->addIndexColumn();

        if (count($this->action)) {
            $queries = $this->actionColumn($queries);
        }
        
        if (method_exists($this, 'columns')) {
            $queries = $this->columns($queries);
        }

        return $queries;
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                ->setTableId("{$this->module}-table")
                ->dom("<'row' <'col-6' l><'col-6' f>><'row' <'col-12' tr>><'row' <'col-6' i><'col-6' p>>")
                ->autoWidth(false)
                ->columns($this->getColumns())
                ->orderBy($this->order)
                ->minifiedAjax();
    }

    protected function filename(): string
    {
        return ucfirst($this->module) . '_' . date('YmdHis');
    }

    protected function actionColumn($data)
    {
        return $data->addColumn('action', function($row) {
            $action = $this->action;
            $result = '';

            if (in_array('edit', $action)) {
                $result .= '<a href="'. baseURL("{$this->module}/{$row->id}/edit") .'" class="btn btn-secondary"><i class="fs-5 ti ti-pencil"></i></a>';
            }

            if (in_array('view', $action)) {
                $result .= '<a href="'. baseURL("{$this->module}/{$row->id}") .'" class="btn btn-success"><i class="fs-5 ti ti-eye"></i></a>';
            }

            if (in_array('delete', $action)) {
                $result .= '<a href="javascript:void(0)" class="btn btn-danger destroy" data-url="'. baseURL("{$this->module}/{$row->id}") .'"><i class="fs-5 ti ti-trash"></i></a>';
            }
            
            return "<div class='datatable-icons'>{$result}</div>";
        });
    }
}
