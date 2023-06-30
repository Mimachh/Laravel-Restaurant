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
        Schema::create('alcool_allergene', function (Blueprint $table) {
            $table->unsignedBigInteger('allergene_id');
            $table->unsignedBigInteger('alcool_id');
            
            $table->foreign('allergene_id')->references('id')->on('allergenes')->onDelete('cascade');
            $table->foreign('alcool_id')->references('id')->on('alcools')->onDelete('cascade');
            
            $table->primary(['allergene_id', 'alcool_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alcool_allergene');
    }
};
