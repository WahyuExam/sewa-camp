<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblGajih extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblgaji', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tglGaji')->nullable();
            $table->integer('karyawanId')->unsigned();
            $table->double('gaji',10)->nullable();
            
            $table->foreign('karyawanId')
                  ->references('id')
                  ->on('tblkaryawan')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblgaji');
    }
}
