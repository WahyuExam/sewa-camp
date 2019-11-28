<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPelanggan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblpelanggan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('idPelanggan',15)->nullable();
            $table->string('nmPelanggan',100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('noTelp',12)->nullable();
            $table->string('email',100)->nullable();
            $table->enum('statusPelanggan',['1','2'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblpelanggan');
    }
}
