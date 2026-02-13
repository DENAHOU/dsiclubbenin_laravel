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
            $table->string('titre');
            $table->string('image')->nullable();
            $table->integer('duree'); // en heures
            $table->date('date');
            $table->time('heure');
            $table->string('lieu')->nullable(); // null si en ligne
            $table->string('lien_formation')->nullable(); // null si présentiel
            $table->string('status')->default('actif');
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
