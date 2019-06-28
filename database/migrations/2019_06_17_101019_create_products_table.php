<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //creation de la table Products
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->text('description')->nullable();
            $table->string('reference');
            $table->integer('price');
            $table->unsignedInteger('category_id')->nullable();
            $table->text('picture')->nullable();
            $table->enum('sales', ['onSales', 'standard']);
            $table->enum('status', ['published', 'unpublished']);
            
            //Si une categorie est supprimée les produits lui appartenant sont supprimés aussi
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //suppression de la table Products
    {
        Schema::dropIfExists('products');
    }
}
