<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
  protected $table = 'detail_pembelian';
  //protected $fillable = ['ID_BERAS', 'NAMA_BERAS', 'HARGA_AGEN', 'HARGA_ECER', 'STOK_BERAS'];
  //public $primaryKey = 'ID_BERAS';
  public $timestamps = false;
  public $incrementing = false;
}
