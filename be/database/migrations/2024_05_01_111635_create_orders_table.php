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
            $table->integer('user_id')->nullable();
            $table->integer('purchased_currency_id');
            $table->decimal('exchange_rate', 10, 6);
            $table->integer('purchased_amount');
            $table->decimal('surcharge_percentage');
            $table->integer('surcharge_amount');
            $table->decimal('discount_percentage')->default(0);
            $table->integer('discount_amount')->default(0);
            $table->integer('total_price');
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
