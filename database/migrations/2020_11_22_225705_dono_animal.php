<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DonoAnimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dono_animal', function (Blueprint $table) {
            $table->unsignedBigInteger("id_animal");
            $table->unsignedBigInteger("id_dono");
            $table->foreign("id_animal")->references("id")->on("animal");
            $table->foreign("id_dono")->references("id")->on("dono");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dono_animal');
    }
}
