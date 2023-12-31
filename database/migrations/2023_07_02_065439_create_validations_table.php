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
        Schema::create('validations', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_online_booking')->nullable();
            $table->boolean('is_booking_when_close')->nullable();
            $table->boolean('is_contact_when_close')->nullable();
            $table->boolean('is_email_confirmation')->nullable();
            $table->boolean('is_automatic_validation')->nullable();
            $table->boolean('is_add_manual_validation')->nullable();
            $table->integer('manual_limit_validation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validations');
    }
};
