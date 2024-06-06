<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManajemenPenjualan extends Model
{
    protected $table = 'manajemen_penjualan'; // Menentukan nama tabel secara eksplisit

    protected $fillable = ['nama_barang', 'jenis_barang', 'jumlah_barang', 'harga_barang', 'penerima_barang', 'tanggal'];

    protected static function boot()
    {
        parent::boot();

        // Hitung total dan simpan ke kolom total sebelum data disimpan
        static::saving(function ($manajemenPenjualan) {
            $manajemenPenjualan->total = $manajemenPenjualan->jumlah_barang * $manajemenPenjualan->harga_barang;
        });
    }
}


