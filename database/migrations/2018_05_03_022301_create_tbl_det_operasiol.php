<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDetOperasiol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbldetoperasional', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('operasionalId')->unsigned();
            $table->string('ket',100)->nullable();
            $table->double('biaya',10,0)->nullable();

            $table->foreign('operasionalId')->references('id')->on('tbloperasional')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbldetoperasional');
    }
}
