<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('microsoft_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Identifiant Microsoft
            $table->string('microsoft_item_id')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            
            // Type
            $table->string('type'); // 'file' ou 'folder'
            $table->string('mime_type')->nullable();
            $table->integer('size')->nullable();
            
            // Dates
            $table->timestamp('created_date')->nullable();
            $table->timestamp('modified_date')->nullable();
            
            // Qui l'a créé/modifié
            $table->string('created_by_name')->nullable();
            $table->string('created_by_email')->nullable();
            $table->string('modified_by_name')->nullable();
            $table->string('modified_by_email')->nullable();
            
            // Lien d'accès
            $table->string('web_url')->nullable();
            
            // Partage
            $table->string('sharing_scope')->nullable(); // 'anonymous', 'organization', 'users'
            $table->json('shared_with')->nullable();
            
            // Synchronisation
            $table->timestamp('synced_at')->useCurrent();
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('type');
            $table->index('modified_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('microsoft_documents');
    }
};
