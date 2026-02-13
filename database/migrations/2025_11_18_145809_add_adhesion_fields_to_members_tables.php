<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdhesionFieldsToMembersTables extends Migration
{
    public function up()
    {
        // users
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users','status')) {
                $table->enum('status', ['pending','approved','rejected'])->default('pending');
            }
            if (!Schema::hasColumn('users','is_paid')) {
                $table->boolean('is_paid')->default(false);
            }
        });

        // companies
        Schema::table('companies', function (Blueprint $table) {
            if (!Schema::hasColumn('companies','status')) {
                $table->enum('status', ['pending','approved','rejected'])->default('pending');
            }
            if (!Schema::hasColumn('companies','is_paid')) {
                $table->boolean('is_paid')->default(false);
            }
        });

        // administrations
        Schema::table('administrations', function (Blueprint $table) {
            if (!Schema::hasColumn('administrations','status')) {
                $table->enum('status', ['pending','approved','rejected'])->default('pending');
            }
            if (!Schema::hasColumn('administrations','is_paid')) {
                $table->boolean('is_paid')->default(false);
            }
        });

        // colleges
        Schema::table('colleges', function (Blueprint $table) {
            if (!Schema::hasColumn('colleges','status')) {
                $table->enum('status', ['pending','approved','rejected'])->default('pending');
            }
            if (!Schema::hasColumn('colleges','is_paid')) {
                $table->boolean('is_paid')->default(false);
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['status','is_paid']);
        });
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['status','is_paid']);
        });
        Schema::table('administrations', function (Blueprint $table) {
            $table->dropColumn(['status','is_paid']);
        });
        Schema::table('colleges', function (Blueprint $table) {
            $table->dropColumn(['status','is_paid']);
        });
    }
}
