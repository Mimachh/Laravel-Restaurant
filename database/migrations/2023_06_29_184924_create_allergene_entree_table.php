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
        Schema::create('allergene_entree', function (Blueprint $table) {
            $table->unsignedBigInteger('allergene_id');
            $table->unsignedBigInteger('entree_id');
            
            $table->foreign('allergene_id')->references('id')->on('allergenes')->onDelete('cascade');
            $table->foreign('entree_id')->references('id')->on('entrees')->onDelete('cascade');
            
            $table->primary(['allergene_id', 'entree_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allergene_entree');
    }
};
