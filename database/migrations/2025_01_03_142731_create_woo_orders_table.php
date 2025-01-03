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
        Schema::create('woo_orders', function (Blueprint $table) {
            
            $table->id();
            $table->integer('order_id')->unique();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->decimal('total', 10, 2);
            $table->string('status');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('woo_orders');
    }
};
