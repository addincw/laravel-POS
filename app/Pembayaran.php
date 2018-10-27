<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
  protected $table = 'Pembayaran';
  // protected $fillable = ['ID_KONSUMEN'];
  public $primaryKey = 'ID_PEMBAYARAN';
  public $timestamps = false;
  public $incrementing = false;
}
