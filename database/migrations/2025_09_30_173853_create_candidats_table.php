<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('candidats', function (Blueprint $table) {
            $table->id();
            // Infos de base
            $table->string('name');
            $table->string('email')->unique();
            $table->string('current_position');
            $table->string('phone')->nullable();
            $table->string('linkedin_profile')->nullable();
            $table->string('cv_path'); // Chemin vers le fichier CV
            
            // Infos extraites du CV par l'IA (en format JSON)
            $table->json('skills')->nullable(); // Stocke une liste de compétences
            $table->json('experiences')->nullable(); // Stocke une liste d'expériences
            $table->json('education')->nullable(); // Stocke une liste de formations

            // Champs pour l'authentification
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('candidats');
    }
};