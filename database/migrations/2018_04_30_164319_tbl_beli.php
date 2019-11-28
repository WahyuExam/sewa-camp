<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblBeli extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblbeli', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kdBeli',20)->nullable();
            $table->date('tglBeli')->nullable();
            $table->integer('suplierId')->unsigned();
            $table->double('ttlBeli',10)->nullable();

            $table->foreign('suplierId')
                  ->references('id')
                  ->on('tblsuplier')
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
        Schema::dropIfExists('tblbeli');
    }
}
