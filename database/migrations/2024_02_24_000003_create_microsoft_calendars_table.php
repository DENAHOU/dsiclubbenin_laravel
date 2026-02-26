<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('microsoft_calendars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Identifiant Microsoft
            $table->string('microsoft_event_id')->unique();
            $table->string('subject');
            $table->text('description')->nullable();
            
            // Dates
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            
            // Détails
            $table->string('organizer_name')->nullable();
            $table->string('organizer_email')->nullable();
            $table->json('attendees')->nullable();
            $table->boolean('is_reminder_on')->default(true);
            $table->integer('reminder_minutes')->default(15);
            
            // Lien
            $table->string('web_url')->nullable();
            
            // Synchronisation
            $table->timestamp('synced_at')->useCurrent();
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('start_time');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('microsoft_calendars');
    }
};
