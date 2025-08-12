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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            
            // Link to the order
            $table->foreignId('order_id')->constrained()->onDelete('cascade');

            // Link to the product
            $table->foreignId('product_id')->constrained()->onDelete('restrict');
             // Product details snapshot (to keep historical pricing even if product changes)
            $table->string('product_name');
            $table->string('product_code')->nullable();
            $table->decimal('price', 10, 2); // price at the time of order
            $table->unsignedInteger('quantity');

            // Subtotal for this item
            $table->decimal('subtotal', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
