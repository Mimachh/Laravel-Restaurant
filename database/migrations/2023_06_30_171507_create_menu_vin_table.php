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
        Schema::create('menu_vin', function (Blueprint $table) {
            $table->unsignedBigInteger('vin_id');
            $table->unsignedBigInteger('menu_id');
            
            $table->foreign('vin_id')->references('id')->on('vins')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            
            $table->primary(['vin_id', 'menu_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_vin');
    }
};
