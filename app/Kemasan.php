<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kemasan extends Model
{
    protected $table = 'Kemasan';
    protected $fillable = ['ID_KEMASAN', 'KETERANGAN_KEMASAN', 'BERAT_KEMASAN'];
    public $primaryKey = 'ID_KEMASAN';
    public $timestamps = false;
    public $incrementing = false;


}
