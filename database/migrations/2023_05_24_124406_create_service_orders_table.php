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
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->char('vehiclePlate', 7)->nullable(false);
            $table->dateTime('entryDateTime')->nullable(false);
            $table->dateTime('exitDateTime')->default('0001-01-01 00:00:00');
            $table->string('priceType', 55);
            $table->decimal('price', 12,2)->default('0.00');
            $table->unsignedBigInteger('userID')->nullable(false);
            $table->timestamps();

            $table->foreign('userId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_orders');
    }
};
