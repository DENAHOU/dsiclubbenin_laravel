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
        Schema::create('formation_registrations', function (Blueprint $table) {
            $table->id();
            // Lien vers la formation
            $table->foreignId('formation_id')->constrained()->onDelete('cascade');
            // Informations sur la personne inscrite
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('company')->nullable();
            $table->string('payment_status')->default('pending'); // 'pending', 'paid'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formation_registrations');
    }
};







