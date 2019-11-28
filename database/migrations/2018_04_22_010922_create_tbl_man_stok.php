<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblManStok extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblstok', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('alatId')->unsigned();
            $table->float('biayaSewa',10)->nullable()->default(0);
            $table->float('biayaDenda',10)->nullable()->default(0);
            $table->integer('stok')->nullable()->default(0);

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
        Schema::dropIfExists('tblstok');
    }
}
