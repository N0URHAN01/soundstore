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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
                // Link to user (nullable for guests)
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
                    // Order reference code (for public use)
            $table->string('order_code')->unique();
            // Order status (pending, processing, shipped, completed, cancelled)
            $table->string('status')->default('pending')->index();
              // Payment info
            $table->string('payment_method')->nullable(); // cash_on_delivery, credit_card, paypal
            $table->string('payment_status')->default('unpaid')->index(); // unpaid, paid, refunded
            $table->boolean('is_paid')->default(false);
            // Financials
            $table->decimal('total_price', 10, 2);
             // Shipping info snapshot (copied from checkout form)
            $table->string('name');
            $table->string('email');
            $table->string('phone_number')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();

            // Tracking number
            $table->string('tracking_number')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
