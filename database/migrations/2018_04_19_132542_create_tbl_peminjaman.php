<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPeminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblpinjam', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kdPinjam',15)->nullable();
            $table->date('tglBooking')->nullable();
            $table->date('tglPinjam')->nullable();
            $table->integer('pelangganId')->unsigned();
            $table->string('statusSewa',2)->nullable();
            $table->string('noJaminan',200)->nullable();
            $table->string('ket',100)->nullable();
            $table->integer('karyawanId')->unsigned();
            $table->float('totalBayar',10)->nullable();
            
            $table->foreign('pelangganId')
                ->references('id')
                ->on('tblpelanggan')
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
        Schema::dropIfExists('tblpinjam');
    }
}
