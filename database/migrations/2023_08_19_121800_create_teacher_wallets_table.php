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
        Schema::create('teacher_wallets', function (Blueprint $table) {
            $table->id();
            $table->double("number_of_hours")->default(1);
            $table->double("actual_of_hours")->default(1);
            $table->double("price")->default(40);
            $table->double("withdraw_money")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_wallets');
    }
};
