<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManajemenPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manajemen_penjualan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_barang')->nullable();
            $table->string('jenis_barang')->nullable();
            $table->integer('jumlah_barang')->nullable();
            $table->integer('harga_barang')->nullable();
            $table->string('penerima_barang')->nullable();
            $table->date('tanggal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manajemen_penjualan');
    }
}
