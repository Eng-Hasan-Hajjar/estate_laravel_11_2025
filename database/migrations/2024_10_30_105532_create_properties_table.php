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
            $table->decimal('price', 12, 2);
            $table->string('currency', 10)->default('USD');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->float('area');
            $table->integer('num_bedrooms');
            $table->integer('num_bathrooms');
            $table->string('directions')->nullable(); // الاتجاهات (يمكن أن تكون أكثر من واحدة)
            $table->integer('num_balconies')->default(0); // عدد الشرفات
            $table->boolean('is_furnished')->default(false); // العقار مفروش أم لا
            $table->enum('status', ['available', 'sold', 'rented', 'unavailable']);
            $table->foreignId('location_id')->nullable()->constrained('locations')->onDelete('cascade');
            $table->foreignId('region_id')->nullable()->constrained('regions')->onDelete('cascade');
            $table->foreignId('property_type_id')->nullable()->constrained('property_types')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
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
