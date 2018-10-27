<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
  protected $table = 'pengadaan';
  // protected $fillable = ['ID_KONSUMEN'];
  public $primaryKey = 'ID_PENGADAAN';
  public $timestamps = false;
  public $incrementing = false;
}
