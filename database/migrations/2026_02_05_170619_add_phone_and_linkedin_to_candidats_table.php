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
        Schema::table('candidats', function (Blueprint $table) {
            if (!Schema::hasColumn('candidats', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            if (!Schema::hasColumn('candidats', 'linkedin_url')) {
                $table->string('linkedin_url')->nullable()->after('phone');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidats', function (Blueprint $table) {
            if (Schema::hasColumn('candidats', 'phone')) {
                $table->dropColumn('phone');
            }
            if (Schema::hasColumn('candidats', 'linkedin_url')) {
                $table->dropColumn('linkedin_url');
            }
        });
    }
};
