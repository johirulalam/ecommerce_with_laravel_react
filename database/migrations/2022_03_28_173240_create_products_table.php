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
            $table->foreignId('category_id')->nullable()->constrained();
            $table->foreignId('subcategory_id')->nullable()->constrained();
            $table->foreignId('brand_id')->nullable()->constrained();
            $table->string('productName', 300)->unique();
            $table->string('productSlug', 350);
            $table->text('productDescription')->nullable();
            $table->string('metaTitle')->nullable();
            $table->string('metaKeyword')->nullable();
            $table->string('metaDescription')->nullable();
            $table->tinyInteger('isFeatured')->default(1);
            $table->tinyInteger('status')->default(1);
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
};
