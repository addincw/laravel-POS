<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrosirBerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beras', function(Blueprint $table){
          $table->string('ID_BERAS');
          $table->string('NAMA_BERAS');
          $table->integer('HARGA_AGEN');
          $table->integer('HARGA_ECER');
          $table->integer('STOK_BERAS');
        });

        Schema::create('kemasan', function(Blueprint $table){
          $table->string('ID_KEMASAN');
          $table->string('KETERANGAN_KEMASAN');
          $table->integer('BERAT_KEMASAN');
          $table->integer('STOK_KEMASAN');
          $table->integer('BEBAN_HARGA');
        });

        Schema::create('konsumen', function(Blueprint $table){
          $table->string('ID_KONSUMEN');
          $table->string('NAMA_KONSUMEN');
          $table->string('ALAMAT_KONSUMEN');
          $table->string('TELPON_KONSUMEN');
        });

        Schema::create('suplier', function(Blueprint $table){
          $table->string('ID_SUPLIER');
          $table->string('NAMA_SUPLIER');
          $table->string('ALAMAT_SUPLIER');
          $table->string('TELPON_SUPLIER');
          $table->string('KETERANGAN');
          $table->string('JENIS_SUPLY');
        });

        Schema::create('harga_khusus', function(Blueprint $table){
          $table->string('ID_KONSUMEN');
          $table->string('ID_BERAS');
          $table->string('ID_ADMIN');
          $table->date('TGL_BERLAKU');
          $table->integer('HARGA_KHUSUS');
          $table->char('STATUS_BERLAKU', 1);
        });

        Schema::create('pembelian', function(Blueprint $table){
          $table->string('ID_PEMBELIAN');
          $table->string('ID_KONSUMEN');
          $table->string('ID_ADMIN');
          $table->string('STATUS_PEMBELIAN');
          $table->timestamp('TGL_PEMBELIAN');
          $table->integer('TOTAL_KILO');
          $table->integer('TOTAL_PEMBELIAN');
        });

        Schema::create('detail_pembelian', function(Blueprint $table){
          $table->string('ID_BERAS');
          $table->string('ID_PEMBELIAN');
          $table->string('ID_KEMASAN');
          $table->integer('JUMLAH_KILO');
          $table->integer('HARGA_BELI_PERKILO');
          $table->integer('TOTAL_HARGA_BELI');
          $table->string('KETERANGAN');
        });

        Schema::create('cicilan_pembelian', function(Blueprint $table){
          $table->integer('ID_CICILAN');
          $table->string('ID_PEMBELIAN');
          $table->integer('ID_ADMIN');
          $table->dateTime('TGL_CICILAN');
          $table->integer('NOMINAL');
          $table->integer('SISA_CICILAN');
        });

        Schema::create('pengadaan', function(Blueprint $table){
          $table->string('ID_PENGADAAN');
          $table->string('ID_ADMIN');
          $table->string('ID_SUPLIER');
          $table->dateTime('TGL_PENGADAAN');
          $table->dateTime('TGL_PELUNASAN');
          $table->integer('JUMLAH_TOTAL')->comment('beras = total kilo, kemasan = total kemasan');
          $table->integer('TOTAL_PENGADAAN');
          $table->string('STATUS_PENGADAAN');
        });

        Schema::create('detail_pengadaan', function(Blueprint $table){
          $table->string('ID_PENGADAAN');
          $table->string('ID_BARANG')->comment('dapat menggunakan id_beras/id_kemasan');
          $table->integer('JUMLAH')->comment('beras dalam kilo, kemasan dalam pieces');
          $table->integer('HARGA_PENGADAAN');
          $table->integer('TOTAL_HARGA');
          $table->string('KETERANGAN');
        });

        Schema::create('pembayaran', function(Blueprint $table){
          $table->string('ID_PEMBAYARAN');
          $table->string('ID_PEMBELIAN');
          $table->dateTime('TGL_PEMBAYARAN');
          $table->integer('TOTAL_PEMBAYARAN');
        });

        Schema::create('pengeluaran', function(Blueprint $table){
          $table->string('ID_PENGELUARAN');
          $table->string('ID_ADMIN');
          $table->string('JENIS_PENGELUARAN');
          $table->integer('JUMLAH_PENGELUARAN');
          $table->dateTime('TGL_PENGELUARAN');
          $table->string('KETERANGAN_PENGELUARAN');
        });

        Schema::create('stok_beras', function(Blueprint $table){
          $table->integer('ID_STOK');
          $table->string('ID_BERAS');
          $table->integer('STOK_TERKINI');
          $table->integer('PERUBAHAN_STOK');
          $table->integer('HARGA_AGEN');
          $table->integer('HARGA_ECER');
          $table->string('JENIS_PERUBAHAN');
          $table->dateTime('TGL_PERUBAHAN');
        });

        Schema::create('admin', function(Blueprint $table){
          $table->integer('ID');
          $table->string('NAMA_ADMIN');
          $table->string('USERNAME');
          $table->string('PASSWORD');
          $table->string('REMEMBER_TOKEN');
        });

        Schema::create('akun', function(Blueprint $table){
          $table->integer('ID_AKUN');
          $table->string('NAMA_AKUN');
        });

        Schema::create('jurnal', function(Blueprint $table){
          $table->integer('ID_JURNAL');
          $table->integer('ID_AKUN');
          $table->string('ID_TRANSAKSI');
          $table->timestamps();
          $table->string('DESKRIPSI');
          $table->integer('JUMLAH_PERUBAHAN');
          $table->string('JENIS_TRANSAKSI');
          $table->integer('SALDO');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('suplier');
        Schema::drop('beras');
        Schema::drop('stok_beras');
        Schema::drop('kemasan');
        Schema::drop('konsumen');
        Schema::drop('harga_khusus');
        Schema::drop('pembelian');
        Schema::drop('detail_pembelian');
        Schema::drop('cicilan_pembelian');
        Schema::drop('pembayaran');
        Schema::drop('pengadaan');
        Schema::drop('detail_pengadaan');
        Schema::drop('pengeluaran');
        Schema::drop('akun');
        Schema::drop('jurnal');
        Schema::drop('admin');
    }
}
