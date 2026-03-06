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
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->enum('type_formation', ['presentiel', 'en_ligne']);
            $table->foreignId('categorie_formation_id')->constrained('categories_formations')->onDelete('cascade');
            $table->string('titre'); // Titre de la formation
            $table->text('description'); // Description complète
            $table->string('image_path')->nullable(); // Image d'illustration
            $table->string('location')->nullable(); // Lieu (pour le présentiel)
            $table->string('online_url')->nullable(); // Lien de la réunion (pour le en ligne)
            $table->dateTime('start_date'); // Date et heure de début
            $table->dateTime('end_date'); // Date et heure de fin
            $table->decimal('price', 10, 2)->default(0); // Prix de la formation
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};










