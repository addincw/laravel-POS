<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
  protected $table = 'pengeluaran';
  // protected $fillable = ['ID_KONSUMEN'];
  public $primaryKey = 'ID_PENGELUARAN';
  public $timestamps = false;
  public $incrementing = false;
}
