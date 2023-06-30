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
        Schema::create('menu_formule', function (Blueprint $table) {
            $table->unsignedBigInteger('formule_id');
            $table->unsignedBigInteger('menu_id');
            
            $table->foreign('formule_id')->references('id')->on('formules')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            
            $table->primary(['formule_id', 'menu_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_formule');
    }
};
