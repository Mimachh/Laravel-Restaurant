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
        Schema::create('allergene_plat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('allergene_id');
            $table->unsignedBigInteger('plat_id');
            $table->timestamps();

            $table->foreign('allergene_id')->references('id')->on('allergenes')->onDelete('cascade');
            $table->foreign('plat_id')->references('id')->on('plats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allergene_plat');
    }
};
