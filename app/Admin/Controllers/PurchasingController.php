<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Purchasing;

class PurchasingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Purchasing';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Purchasing());

        $grid->column('id', __('Id'));
        $grid->column('nama_barang', __('Nama Barang'));
        $grid->column('jumlah_barang', __('Jumlah Barang'));
        $grid->column('harga_barang', __('Harga Barang'));
        $grid->column('supplier_barang', __('Supplier Barang'));
        $grid->column('status', __('Status'));
        $grid->column('tanggal', __('Tanggal'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Purchasing::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nama_barang', __('Nama Barang'));
        $show->field('jumlah_barang', __('Jumlah Barang'));
        $show->field('harga_barang', __('Harga Barang'));
        $show->field('supplier_barang', __('Supplier Barang'));
        $show->field('status', __('Status'));
        $show->field('tanggal', __('Tanggal'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Purchasing());

        $form->text('nama_barang', __('Nama Barang'));
        $form->number('jumlah_barang', __('Jumlah Barang'));
        $form->number('harga_barang', __('Harga Barang'));
        $form->text('supplier_barang', __('Supplier Barang'));
        $form->text('status', __('Status'));
        $form->date('tanggal', __('Tanggal'))->default(date('Y-m-d'));

        return $form;
    }
}
