<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('partners_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ex: Gold, Silver, Institutionnel
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partners_types');
    }
};
