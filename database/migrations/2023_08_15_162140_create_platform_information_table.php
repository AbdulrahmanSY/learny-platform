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
        Schema::create('platform_information', function (Blueprint $table) {
            $table->id();
            $table->text('about_us_ar');
            $table->text('about_us_en');
            $table->text('terms_of_service_ar');
            $table->text('terms_of_service_en');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platform_information');
    }
};
