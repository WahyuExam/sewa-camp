<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDetailPeminjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbldetailpinjam', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alatId')->unsigned();
            $table->integer('jml')->nullable();
            $table->float('ttlBiaya',10)->nullable();
            $table->float('ttlDenda',10)->nullable();
            $table->integer('pinjamId')->unsigned();

            $table->foreign('alatId')
                ->references('id')
                ->on('tblalat')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('pinjamId')
                ->references('id')
                ->on('tblpinjam')
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
        Schema::dropIfExists('tbldetailpinjam');
    }
}
