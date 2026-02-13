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
        Schema::table('formations', function (Blueprint $table) {
            // Ajouter les champs d'inscription
            if (!Schema::hasColumn('formations', 'lien_inscription_en_ligne')) {
                $table->string('lien_inscription_en_ligne')->nullable()->after('lien_formation');
            }
            
            if (!Schema::hasColumn('formations', 'lien_inscription_presentiel')) {
                $table->string('lien_inscription_presentiel')->nullable()->after('lien_inscription_en_ligne');
            }
            
            if (!Schema::hasColumn('formations', 'prix_en_ligne')) {
                $table->decimal('prix_en_ligne', 10, 2)->nullable()->after('lien_inscription_presentiel');
            }
            
            if (!Schema::hasColumn('formations', 'prix_presentiel')) {
                $table->decimal('prix_presentiel', 10, 2)->nullable()->after('prix_en_ligne');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formations', function (Blueprint $table) {
            $table->dropColumn([
                'lien_inscription_en_ligne',
                'lien_inscription_presentiel', 
                'prix_en_ligne',
                'prix_presentiel'
            ]);
        });
    }
};
