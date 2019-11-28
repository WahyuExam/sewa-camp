<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblOperasiol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbloperasional', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kdOperasional',25)->nullable();
            $table->date('tgloperasional')->nullable();
            $table->double('biayaOperasional',10,0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbloperasional');
    }
}
