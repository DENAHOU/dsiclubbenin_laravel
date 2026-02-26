<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('microsoft_meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Identifiant Microsoft
            $table->string('microsoft_meeting_id')->unique();
            $table->string('subject');
            $table->text('description')->nullable();
            
            // Dates
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            
            // Participants
            $table->string('organizer_name')->nullable();
            $table->string('organizer_email')->nullable();
            $table->json('participants')->nullable();
            $table->integer('participant_count')->default(0);
            
            // Détails Teams
            $table->string('join_url')->nullable();
            $table->string('provider')->nullable(); // 'teamsForBusiness', 'skypeForBusiness', etc.
            
            // Lien
            $table->string('web_url')->nullable();
            
            // Status
            $table->string('status')->default('scheduled'); // 'scheduled', 'ongoing', 'ended', 'cancelled'
            
            // Synchronisation
            $table->timestamp('synced_at')->useCurrent();
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('start_time');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('microsoft_meetings');
    }
};
