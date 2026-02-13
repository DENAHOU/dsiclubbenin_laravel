<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('esns', function (Blueprint $table) {
            $table->id();

            // Infos Identité
            $table->string('promoter_name');       // NomPromotteur
            $table->string('civility');             // Civilite
            $table->string('company_name');         // NomEntreprise
            $table->string('professional_email');   // EmailPro
            $table->string('professional_phone');   // PhonePro
            $table->string('location');             // Emplacement
            $table->string('legal_form');           // FormeJuridique
            $table->string('website_url')->nullable(); // Url

            // Infos Expertise
            $table->string('activity_domain');      // DomaineActivite
            $table->date('creation_date');          // DateCreation
            $table->string('experience_years');     // AnneeExperience
            $table->string('staff_count');          // NombrePersonnel
            $table->string('turnover');             // ChiffreAffaire
            $table->string('esn_type');             // TypeEsn
            $table->text('description');

            // Infos Finalisation & Compte
            $table->string('trade_register_path')->nullable(); // RegistreCommerce
            $table->string('logo_path')->nullable();           // LogoEntreprise
            $table->string('password');             // Mot de passe pour la gestion

            // Champs standards pour l'authentification
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('esns');
    }
};
