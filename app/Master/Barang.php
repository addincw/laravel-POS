<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    public $primaryKey = 'ID_BARANG';
    public $timestamps = false;
    public $incrementing = false;

    public function Kategori(){
      return $this->belongsTo('App\Master\Kategori', 'ID_KATEGORI');
    }

    public function SatuanBarang(){
      return $this->belongsTo('App\Master\SatuanBarang', 'ID_SATUAN_BARANG');
    }

    public function Merk(){
      return $this->belongsTo('App\Master\Merk', 'ID_MERK');
    }
}
