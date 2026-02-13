<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('administrations', function (Blueprint $table) {
            $table->id();

            // Section 1: Présentation
            $table->string('name'); // Nom de l'Administration
            $table->string('entity_type'); // Ministère, Agence, etc.
            $table->string('address');
            $table->string('website_url')->nullable();
            $table->string('logo_path')->nullable();

            // Section 2: Contact
            $table->string('contact_name');
            $table->string('contact_position');
            $table->string('contact_email');
            $table->string('contact_phone');
            
            // Section 3: Axes de Modernisation
            $table->string('main_project')->nullable();
            $table->text('tech_challenges')->nullable(); // Stockera les tags comme "tag1,tag2,tag3"
            $table->text('searched_expertise')->nullable(); // Idem

            // Section 4: Compte de Gestion
            $table->string('email')->unique(); // E-mail de connexion
            $table->string('password');
            $table->rememberToken();

            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('administrations');
    }
};