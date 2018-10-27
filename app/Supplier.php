<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suplier';
    protected $fillable = ['NAMA_SUPPLIER', 'TELPON_SUPPLIER', 'ALAMAT_SUPPLIER', 'KETERANGAN', 'JENIS_SUPPLY'];
    public $primaryKey = 'ID_SUPPLIER';
    public $timestamps = false;
    public $incrementing = false;


}
