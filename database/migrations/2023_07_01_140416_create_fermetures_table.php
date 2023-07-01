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
        Schema::create('fermetures', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->nullable();
            $table->string('date_debut')->nullable();
            $table->string('date_fin')->nullable();
            $table->string('raison')->nullable();
            $table->boolean('is_closed_can_reserved')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fermetures');
    }
};
