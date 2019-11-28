<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblSumplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblsuplier', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kdSuplier',15)->nullable();
            $table->string('nmSuplier',100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('noTelp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblsuplier');
    }
}
