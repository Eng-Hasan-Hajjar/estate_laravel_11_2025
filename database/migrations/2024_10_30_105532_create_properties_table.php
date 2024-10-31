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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id'); // أضف هذا السطر
         


            $table->string('title', 255);
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->enum('type', ['apartment', 'house', 'villa', 'land', 'office', 'shop']);
            $table->string('location', 255);
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->float('area');
            $table->integer('num_bedrooms');
            $table->integer('num_bathrooms');
            $table->enum('status', ['available', 'sold', 'rented', 'unavailable']);
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
