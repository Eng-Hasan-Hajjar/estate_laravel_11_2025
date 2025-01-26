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
        Schema::table('properties', function (Blueprint $table) {
            $table->string('directions')->nullable()->after('status'); // الاتجاهات (يمكن أن تكون أكثر من واحدة)
            $table->integer('num_balconies')->default(0)->after('directions'); // عدد الشرفات
            $table->boolean('is_furnished')->default(false)->after('num_balconies'); // العقار مفروش أم لا
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['directions', 'num_balconies', 'is_furnished']);
        
        });
    }
};
