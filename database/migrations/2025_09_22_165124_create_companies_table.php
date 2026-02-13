<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            // Informations sur l'entreprise
            $table->string('name');
            $table->string('ifu')->nullable();
            $table->string('address');
            $table->string('phone');
            $table->string('sector');
            $table->string('service_category');
            $table->string('membership_type');
            $table->string('turnover')->nullable();
            $table->string('logo_path')->nullable();

            // Informations sur le contact principal de l'entreprise
            $table->string('contact_name');
            $table->string('contact_position');
            $table->string('contact_phone');

            // Informations pour l'authentification de l'entreprise
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('companies');
    }
};
