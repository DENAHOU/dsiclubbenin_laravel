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
        Schema::table('users', function (Blueprint $table) {
            // Stocke le token d'accès Microsoft (pour appeler Microsoft Graph API)
            $table->longText('microsoft_token')->nullable()->after('microsoft_id');
            
            // Stocke le refresh token (pour renouveler le token expiré)
            $table->longText('microsoft_refresh_token')->nullable()->after('microsoft_token');
            
            // Date d'expiration du token (pour savoir quand le renouveler)
            $table->timestamp('microsoft_token_expires_at')->nullable()->after('microsoft_refresh_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['microsoft_token', 'microsoft_refresh_token', 'microsoft_token_expires_at']);
        });
    }
};
