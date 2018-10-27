<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    protected $table = 'konsumen';
    protected $fillable = ['NAMA_KONSUMEN', 'TELPON_KONSUMEN', 'ALAMAT_KONSUMEN'];
    public $primaryKey = 'ID_KONSUMEN';
    public $timestamps = false;
    public $incrementing = false;


}
