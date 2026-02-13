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
            // On ajoute nos nouvelles colonnes
            $table->string('sector_other')->nullable()->after('sector');
            $table->string('category_other')->nullable()->after('category_of_service');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // On définit comment annuler ces changements
            $table->dropColumn(['sector_other', 'category_other']);
        });
    }
};
