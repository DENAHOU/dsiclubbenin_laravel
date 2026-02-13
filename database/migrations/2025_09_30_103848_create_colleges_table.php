<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('colleges', function (Blueprint $table) {
            $table->id();

            // Section 1: Visibilité
            $table->string('company_name');
            $table->string('logo_path')->nullable();
            $table->string('slogan');
            $table->text('description');
            $table->string('website_url')->nullable();
            $table->string('linkedin_url')->nullable();

            // Section 2: Réseau & Opportunités
            $table->json('target_profiles')->nullable(); // Stockera les cibles (Banques, Telco...)
            $table->string('expertise_tags');
            $table->text('main_innovation');

            // Section 3: Contributions
            $table->json('contribution_types')->nullable(); // Stockera les types de contributions
            $table->text('training_needs')->nullable();

            // Section 4: Compte
            $table->string('contact_name');
            $table->string('email')->unique();
            $table->string('password');

            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('colleges');
    }
};
