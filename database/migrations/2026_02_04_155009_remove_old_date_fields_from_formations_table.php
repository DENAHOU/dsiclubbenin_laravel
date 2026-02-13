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
            // Supprimer les anciens champs date et heure s'ils existent
            if (Schema::hasColumn('formations', 'date')) {
                $table->dropColumn('date');
            }
            if (Schema::hasColumn('formations', 'heure')) {
                $table->dropColumn('heure');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formations', function (Blueprint $table) {
            // Restaurer les anciens champs si nécessaire
            if (!Schema::hasColumn('formations', 'date')) {
                $table->date('date')->nullable();
            }
            if (!Schema::hasColumn('formations', 'heure')) {
                $table->time('heure')->nullable();
            }
        });
    }
};
