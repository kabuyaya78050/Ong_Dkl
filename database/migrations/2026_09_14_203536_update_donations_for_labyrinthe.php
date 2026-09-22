<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {

            // Numéro de commande généré par Labyrinthe
            $table->string('order_number')
                ->nullable()
                ->after('transaction_reference');

            // Référence de la transaction Labyrinthe
            $table->string('labyrinthe_reference')
                ->nullable()
                ->after('order_number');

        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn([
                'order_number',
                'labyrinthe_reference',
            ]);
        });
    }
};