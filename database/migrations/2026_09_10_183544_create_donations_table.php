<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('donor_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->decimal('amount', 15, 2);

            $table->enum('payment_method', [
                'cash',
                'mobile_money',
                'bank',
                'online'
            ])->default('cash');

            $table->enum('status', [
                'pending',
                'confirmed',
                'cancelled'
            ])->default('pending');

            $table->string('transaction_reference')->nullable();

            $table->text('message')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};