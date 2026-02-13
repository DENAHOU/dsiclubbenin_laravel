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
        Schema::create('partner_formules', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // Nom de la formule
            $table->decimal('amount', 12, 0); // Prix
            $table->text('description')->nullable();
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_formules');
    }
};
