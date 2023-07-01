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
        Schema::create('jours', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->time('ouverture_midi')->nullable();
            $table->time('fermeture_midi')->nullable();

            $table->time('ouverture_soir')->nullable();
            $table->time('fermeture_soir')->nullable();

            $table->boolean('is_open_midi')->nullable();
            $table->boolean('is_open_soir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jours');
    }
};
