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
               $table->foreignId('category_id')->constrained()->onDelete('cascade');
               $table->json('images')->nullable(); // store multiple image URLs/paths
               $table->text('description')->nullable();
               $table->string('color')->nullable();
               $table->decimal('price', 10, 2);
               $table->integer('stock')->default(0);
               $table->boolean('is_active')->default(true);
               $table->string('product_code')->unique();
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
