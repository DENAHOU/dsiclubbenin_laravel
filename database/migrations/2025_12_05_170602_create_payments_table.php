<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->morphs('payable'); // flexible : payable_type / payable_id (user/company/...)
            $table->string('transaction_id')->unique();
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('XOF');
            $table->string('payment_method')->nullable();
            $table->string('status')->default('pending'); // pending, completed, failed
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->json('meta')->nullable(); // stocke réponse raw si besoin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

