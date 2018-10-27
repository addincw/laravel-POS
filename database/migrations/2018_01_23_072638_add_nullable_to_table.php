<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('beras', function($table)
      {
        $table->integer('HARGA_AGEN')->nullable()->change();
        $table->integer('HARGA_ECER')->nullable()->change();
        $table->integer('STOK_BERAS')->nullable()->change();
      });

      Schema::table('kemasan', function($table)
      {
          $table->integer('STOK_KEMASAN')->nullable()->change();
          $table->integer('BEBAN_HARGA')->nullable()->change();
      });

      Schema::table('suplier', function($table)
      {
        $table->string('ALAMAT_SUPLIER')->nullable()->change();
        $table->string('TELPON_SUPLIER')->nullable()->change();
        $table->string('KETERANGAN')->nullable()->change();
        $table->string('JENIS_SUPLY')->nullable()->change();
      });

      Schema::table('pembelian', function($table)
      {
        $table->string('STATUS_PEMBELIAN')->nullable()->change();
        $table->dateTime('TGL_PEMBELIAN')->nullable()->change();
        $table->integer('TOTAL_KILO')->nullable()->change();
        $table->integer('TOTAL_PEMBELIAN')->nullable()->change();
      });

      Schema::table('detail_pembelian', function($table)
      {
        $table->integer('JUMLAH_KILO')->nullable()->change();
        $table->integer('HARGA_BELI_PERKILO')->nullable()->change();
        $table->integer('TOTAL_HARGA_BELI')->nullable()->change();
        $table->string('KETERANGAN')->nullable()->change();
      });

      Schema::table('pengadaan', function($table){
        $table->dateTime('TGL_PENGADAAN')->nullable()->change();
        $table->dateTime('TGL_PELUNASAN')->nullable()->change();
        $table->integer('JUMLAH_TOTAL')->nullable()->change();
        $table->integer('TOTAL_PENGADAAN')->nullable()->change();
        $table->string('STATUS_PENGADAAN')->nullable()->change();
      });

      Schema::table('detail_pengadaan', function($table){
        $table->integer('JUMLAH')->nullable()->change();
        $table->integer('HARGA_PENGADAAN')->nullable()->change();
        $table->integer('TOTAL_HARGA')->nullable()->change();
        $table->string('KETERANGAN')->nullable()->change();
      });

      Schema::table('pembayaran', function($table){
        $table->dateTime('TGL_PEMBAYARAN')->nullable()->change();
        $table->integer('TOTAL_PEMBAYARAN')->nullable()->change();
      });

      Schema::table('pengeluaran', function($table){
        $table->string('JENIS_PENGELUARAN')->nullable()->change();
        $table->integer('JUMLAH_PENGELUARAN')->nullable()->change();
        $table->dateTime('TGL_PENGELUARAN')->nullable()->change();
        $table->string('KETERANGAN_PENGELUARAN')->nullable()->change();
      });

      Schema::table('stok_beras', function($table){
        $table->integer('STOK_TERKINI')->nullable()->change();
        $table->integer('PERUBAHAN_STOK')->nullable()->change();
        $table->integer('HARGA_AGEN')->nullable()->change();
        $table->integer('HARGA_ECER')->nullable()->change();
        $table->string('JENIS_PERUBAHAN')->nullable()->change();
        $table->dateTime('TGL_PERUBAHAN')->nullable()->change();
      });

      Schema::table('jurnal', function($table){
        $table->string('ID_TRANSAKSI')->nullable()->change();
        $table->string('DESKRIPSI')->nullable()->change();
        $table->integer('JUMLAH_PERUBAHAN')->nullable()->change();
        $table->string('JENIS_TRANSAKSI')->nullable()->change();
        $table->integer('SALDO')->nullable()->change();
      });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
