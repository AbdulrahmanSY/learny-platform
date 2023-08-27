<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('package_hours', function (Blueprint $table) {
            $table->id();
            $table->integer('number_of_hours');
            $table->double('discount');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_hours');
    }
};
