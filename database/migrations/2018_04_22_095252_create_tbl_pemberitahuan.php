<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPemberitahuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblpemberitahuan', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl')->nullable();
            $table->text('isi')->nullable();
            $table->integer('status')->nullable();
            $table->integer('statusUser')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblpemberitahuan');
    }
}
