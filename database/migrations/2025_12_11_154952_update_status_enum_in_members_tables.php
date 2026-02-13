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
        // USERS
        DB::statement("ALTER TABLE users MODIFY status ENUM('pending','approved','rejected','blocked') DEFAULT 'pending'");

        // COMPANIES
        DB::statement("ALTER TABLE companies MODIFY status ENUM('pending','approved','rejected','blocked') DEFAULT 'pending'");

        // ADMINISTRATIONS
        DB::statement("ALTER TABLE administrations MODIFY status ENUM('pending','approved','rejected','blocked') DEFAULT 'pending'");

        // COLLEGES
        DB::statement("ALTER TABLE colleges MODIFY status ENUM('pending','approved','rejected','blocked') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Retour en arrière si nécessaire
        DB::statement("ALTER TABLE users MODIFY status ENUM('pending','approved','rejected') DEFAULT 'pending'");
        DB::statement("ALTER TABLE companies MODIFY status ENUM('pending','approved','rejected') DEFAULT 'pending'");
        DB::statement("ALTER TABLE administrations MODIFY status ENUM('pending','approved','rejected') DEFAULT 'pending'");
        DB::statement("ALTER TABLE colleges MODIFY status ENUM('pending','approved','rejected') DEFAULT 'pending'");
    }
};
