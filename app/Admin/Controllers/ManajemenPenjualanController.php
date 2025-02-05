<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show; 
use \App\Models\ManajemenPenjualan;

class ManajemenPenjualanController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Manajemen Penjualan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ManajemenPenjualan());

        $grid->column('id', __('Id'));
        $grid->column('nama_barang', __('Nama barang'));
        $grid->column('jenis_barang', __('Jenis barang'));
        $grid->column('jumlah_barang', __('Jumlah barang'));
        $grid->column('harga_barang', __('Harga barang'));
        $grid->column('penerima_barang', __('Penerima barang'));
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
        $show = new Show(ManajemenPenjualan::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nama_barang', __('Nama barang'));
        $show->field('jenis_barang', __('Jenis barang'));
        $show->field('jumlah_barang', __('Jumlah barang'));
        $show->field('harga_barang', __('Harga barang'));
        $show->field('penerima_barang', __('Penerima barang'));
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
        $form = new Form(new ManajemenPenjualan());

        $form->text('nama_barang', __('Nama barang'));
        $form->text('jenis_barang', __('Jenis barang'));
        $form->number('jumlah_barang', __('Jumlah barang'));
        $form->number('harga_barang', __('Harga barang'));
        $form->text('penerima_barang', __('Penerima barang'));
        $form->date('tanggal', __('Tanggal'))->default(date('Y-m-d'));

        return $form;
    }
}
