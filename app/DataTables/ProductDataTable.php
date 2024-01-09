<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){
                $editBtn = "<a href='".route('admin.products.edit', $query->id)."' class='btn btn-primary'>Edit</a>";
                $deleteBtn = "<a href='".route('admin.products.destroy', $query->id)."' class='btn btn-danger ml-2 delete-item'>Delete</a>";
                $actionBtn = '<div class="dropdown dropleft d-inline">
                <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog"></i>
                </button>
                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                  <a class="dropdown-item has-icon" href="'.route('admin.products-image-gallery.index',  ['product' => $query->id]).'"><i class="far fa-heart"></i> Image Gallery</a>
                  <a class="dropdown-item has-icon" href="'.route('admin.products-variant.index',  ['product' => $query->id]).'"><i class="far fa-file"></i>Variants</a>
                  <a class="dropdown-item has-icon" href="#"><i class="far fa-clock"></i> Something else here</a>
                </div>
              </div>'; 
                return $editBtn.$deleteBtn.$actionBtn;
            })
            
            ->addColumn('thumb_image',function($query){
                return $img = "<img width='80' src= '".asset($query->thumb_image)."'></img>";
            })
            ->addColumn('status', function($query){
                if ($query->status == 1) {
                    $button = '<label class="custom-switch mt-2">
                    <input type="checkbox" checked name="custom-switch-checkbox" data-id="'.$query->id.'" class="custom-switch-input change-status">
                    <span class="custom-switch-indicator"></span>
                  </label>';  
                }else{
                    $button = '<label class="custom-switch mt-2">
                    <input type="checkbox" name="custom-switch-checkbox" data-id="'.$query->id.'" class="custom-switch-input change-status">
                    <span class="custom-switch-indicator"></span>
                  </label>';
                }
                
              return $button;
            })
            ->addColumn('product_type', function($query){
                switch ($query->product_type) {
                    case 'new_arrival':
                        return '<i class="badge badge-primary">New Arrival</i>';
                        break;
                    case 'featured_product':
                        return '<i class="badge badge-info">Featured</i>';
                        break;
                    case 'best_product':
                        return '<i class="badge badge-success">Best Product</i>';
                        break;
                    case 'top_product':
                        return '<i class="badge badge-warning">Top Product</i>';
                        break;
                    default:
                        return '<i class="badge badge-danger">None</i>';
                        break;
                }
            })
            ->rawColumns(['thumb_image','action','status','product_type'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
           
            Column::make('id')->width(60),
            Column::make('thumb_image')->width(200),
            Column::make('name'),
            Column::make('price')->width(60),
            Column::make('product_type'),
            Column::make('qty')->width(90),
            Column::make('status')->width(100),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(300)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
