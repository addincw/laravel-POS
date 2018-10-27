<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
  protected $table = 'Pembelian';
  protected $fillable = ['ID_KONSUMEN'];
  public $primaryKey = 'ID_PEMBELIAN';
  public $timestamps = false;
  public $incrementing = false;
}
