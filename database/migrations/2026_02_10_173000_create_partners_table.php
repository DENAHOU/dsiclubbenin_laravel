<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            
            // Informations générales
            $table->string('name'); // Nom du partenaire
            $table->text('description')->nullable(); // Description
            $table->string('logo')->nullable(); // Chemin du logo
            
            // Contact
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_person')->nullable(); // Personne à contacter
            
            // Informations web
            $table->string('website')->nullable();
            $table->string('linkedin_url')->nullable();
            
            // Type et statut
            $table->string('partner_type')->default('standard'); // gold, silver, bronze, premium, standard
            $table->boolean('is_active')->default(true);
            $table->boolean('is_paid')->default(false);
            
            // Compte utilisateur
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->rememberToken()->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
