<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblRugiLaba extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblrugilaba', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bulan')->nullable();
            $table->integer('tahun')->nullable();
            $table->string('keterangan',50)->nullable();
            $table->decimal('pendapatan')->nullable();
            $table->decimal('pengeluaran')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblrugilaba');
    }
}
