<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblbrang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblalat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kdAlat',15)->nullable();
            $table->string('nmAlat',100)->nullable();
            $table->string('merkAlat',100)->nullable();
            $table->text('ketAlat')->nullable();
            $table->text('fotoAlat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblalat');
    }
}
