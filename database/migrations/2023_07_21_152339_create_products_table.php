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
            $table->string('name');
            $table->string('slug')->unique();

            $table->foreignId('category_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

            $table->foreignId('brand_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

            $table->string('primary_image');
            $table->string('description');

            $table->integer('status')->default(1);
            $table->boolean('is_active');

            $table->integer('delivery_amount');
            $table->boolean('delivery_amount_per_product')->nullable();


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
