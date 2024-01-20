<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('secondary_category_id')
                ->constrained();
            $table->string('name')
            ->nullable();
            $table->text('information')
            ->nullable();
            $table->unsignedInteger('price')
            ->nullable();
            $table->boolean('is_selling')
            ->nullable();
            $table->integer('sort_order')
            ->nullable();
            $table->foreignId('image1')
                ->nullable()
                ->constrained('images');
            $table->foreignId('image2')
                ->nullable()
                ->constrained('images');
            $table->foreignId('image3')
                ->nullable()
                ->constrained('images');
            $table->foreignId('image4')
                ->nullable()
                ->constrained('images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
