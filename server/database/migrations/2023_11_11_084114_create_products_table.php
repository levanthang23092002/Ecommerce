<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('regular_price',8,0);
            $table->decimal('sale_price',8,0)->nullable();
            $table->string('ISBN')->nullable();
            $table->string('cover_type');
            $table->string('size')->nullable();
            $table->string('release_date')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('pages')->nullable();
            $table->string('language')->nullable();
            $table->string('demographic')->nullable();
            $table->string('stock_status');
            $table->unsignedInteger('quantity')->default(10);
            $table->string('image');
            $table->softDeletes();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('author_id')->unsigned()->nullable();
            $table->bigInteger('publisher_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('cascade');
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
};
