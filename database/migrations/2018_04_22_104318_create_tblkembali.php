<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblkembali extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblkembali', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kdKembali',20)->nullable();
            $table->date('tglkembali')->nullable();
            $table->string('durasi',100)->nullable();
            $table->float('denda',10)->nullable()->default(0);
            $table->integer('pinjamId')->unsigned();
            $table->integer('karyawanId')->unsigned();

            $table->foreign('pinjamId')
                ->references('id')
                ->on('tblpinjam')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('tblkembali');
    }
}
