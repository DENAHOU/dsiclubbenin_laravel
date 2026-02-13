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
            // Ajouter video_url seulement s'il n'existe pas
            if (!Schema::hasColumn('formations', 'video_url')) {
                $table->string('video_url')->nullable()->after('image');
            }
            
            // Supprimer duree s'il existe et ajouter les dates
            if (Schema::hasColumn('formations', 'duree')) {
                $table->dropColumn('duree');
            }
            
            if (!Schema::hasColumn('formations', 'date_debut')) {
                $table->date('date_debut')->nullable()->after('categorie_formation_id');
            }
            
            if (!Schema::hasColumn('formations', 'date_fin')) {
                $table->date('date_fin')->nullable()->after('date_debut');
            }
            
            if (!Schema::hasColumn('formations', 'date_cloture_inscription')) {
                $table->date('date_cloture_inscription')->nullable()->after('date_fin');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formations', function (Blueprint $table) {
            $table->dropColumn(['video_url', 'date_debut', 'date_fin', 'date_cloture_inscription']);
            
            if (!Schema::hasColumn('formations', 'duree')) {
                $table->integer('duree')->after('image');
            }
        });
    }
};
