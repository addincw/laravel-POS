<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttributTableAkun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('akun', function($table){
          $table->string('ID_BERAS')->nullable();
          $table->string('ID_KEMASAN')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('akun', function($table){
        $table->dropColumn('ID_BERAS');
        $table->dropColumn('ID_KEMASAN');
      });
    }
}
