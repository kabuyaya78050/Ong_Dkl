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

            // Projet soutenu
            $table->foreignId('project_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Informations du donateur
            $table->string('donor_name');
            $table->string('email')->nullable();
            $table->string('phone');

            // Montant
            $table->decimal('amount', 15, 2);

            // Opérateur Mobile Money
            $table->enum('payment_method', [
                'mpesa',
                'airtel_money',
                'orange_money',
                'africell',
            ]);

            // État du paiement
            $table->enum('status', [
                'pending',
                'confirmed',
                'cancelled',
            ])->default('pending');

            // Référence fournie par Labyrinthe
            $table->string('transaction_reference')
                ->nullable()
                ->unique();

            // Message du donateur
            $table->text('message')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};