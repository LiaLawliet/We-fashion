<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //creation de la table Sizes
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //suppression de la table Sizes
    {
        Schema::dropIfExists('sizes');
    }
}
