<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblkaryawan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idKaryawan',15)->nullable();
            $table->string('nmKaryawan',100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('noTelp',15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblkaryawan');
    }
}
