<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()  //creation de la table d'association entre Sizes et Products
    {
        Schema::create('product_size', function (Blueprint $table) {
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('size_id');
            
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //suppression de la table d'association entre Sizes et Products
    {
        Schema::dropIfExists('product_size');
    }
}
