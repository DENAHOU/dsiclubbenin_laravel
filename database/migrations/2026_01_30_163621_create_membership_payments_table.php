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
        Schema::create('membership_payments', function (Blueprint $table) {
            $table->id();

            // 🔗 Relation polymorphique
            $table->morphs('payable');
            // payable_id
            // payable_type (Company, College, Administration)

            $table->integer('amount');
            $table->string('period')->default('year'); // year
            $table->string('status')->default('pending'); // pending | paid
            $table->string('transaction_reference')->nullable();
            $table->string('invoice_path')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_payments');
    }
};
