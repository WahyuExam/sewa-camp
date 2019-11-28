<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblDetBeli extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbldetbeli', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('beliId')->unsigned();
            $table->integer('alatId')->unsigned();
            $table->double('hargaBeli',10)->nullable();
            $table->integer('jmlBeli')->nullable();
            $table->double('sub',10)->nullable();
            
            $table->foreign('beliId')
                  ->references('id')
                  ->on('tblbeli')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('alatId')
                  ->references('id')
                  ->on('tblalat')
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
        Schema::dropIfExists('tbldetbeli');
    }
}
