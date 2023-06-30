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
        Schema::create('allergene_soft', function (Blueprint $table) {
            $table->unsignedBigInteger('allergene_id');
            $table->unsignedBigInteger('soft_id');
            
            $table->foreign('allergene_id')->references('id')->on('allergenes')->onDelete('cascade');
            $table->foreign('soft_id')->references('id')->on('softs')->onDelete('cascade');
            
            $table->primary(['allergene_id', 'soft_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allergene_soft');
    }
};
