<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid; 
use OpenAdmin\Admin\Show;
use \App\Models\ManajemenPersediaan;

class ManajemenPersediaanControllers extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ManajemenPersediaan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ManajemenPersediaan());

        $grid->column('id', __('Id'));
        $grid->column('nama_barang', __('Nama barang'));
        $grid->column('deskripsi', __('Deskripsi'));
        $grid->column('lokasi', __('Lokasi'));
        $grid->column('stok', __('Stok'));
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
        $show = new Show(ManajemenPersediaan::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nama_barang', __('Nama barang'));
        $show->field('deskripsi', __('Deskripsi'));
        $show->field('lokasi', __('Lokasi'));
        $show->field('stok', __('Stok'));
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
        $form = new Form(new ManajemenPersediaan());

        $form->text('nama_barang', __('Nama barang'));
        $form->text('deskripsi', __('Deskripsi'));
        $form->text('lokasi', __('Lokasi'));
        $form->number('stok', __('Stok'));
        $form->date('tanggal', __('Tanggal'))->default(date('Y-m-d'));

        return $form;
    }
}
