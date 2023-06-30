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
        Schema::create('menu_alcool', function (Blueprint $table) {
            $table->unsignedBigInteger('alcool_id');
            $table->unsignedBigInteger('menu_id');
            
            $table->foreign('alcool_id')->references('id')->on('alcools')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            
            $table->primary(['alcool_id', 'menu_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_alcool');
    }
};
