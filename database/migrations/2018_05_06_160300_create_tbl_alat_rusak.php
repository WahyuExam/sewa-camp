<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblAlatRusak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblalatrusak', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alatId')->unsigned();
            $table->integer('jmlRusak')->default(0);

            $table->foreign('alatId')->references('id')->on('tblalat')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblalatrusak');
    }
}
