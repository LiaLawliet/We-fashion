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
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->text('description')->nullable();
            $table->string('reference');
            $table->integer('price');
            $table->unsignedInteger('genre_id')->nullable();
            $table->text('picture')->nullable();
            $table->enum('sales', ['onSales', 'standard']);
            $table->enum('status', ['published', 'unpublished']);
            
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
