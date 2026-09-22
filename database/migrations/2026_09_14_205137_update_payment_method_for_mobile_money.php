<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->string('payment_method_new')
                ->nullable()
                ->after('amount');
        });

        // Copier les anciennes valeurs vers la nouvelle colonne.
        DB::table('donations')->update([
            'payment_method_new' => DB::raw('payment_method::text'),
        ]);

        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn('payment_method');
        });

        Schema::table('donations', function (Blueprint $table) {
            $table->renameColumn(
                'payment_method_new',
                'payment_method'
            );
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->string('payment_method_old')
                ->nullable()
                ->after('amount');
        });

        DB::table('donations')->update([
            'payment_method_old' => DB::raw('payment_method'),
        ]);

        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn('payment_method');
        });

        Schema::table('donations', function (Blueprint $table) {
            $table->renameColumn(
                'payment_method_old',
                'payment_method'
            );
        });
    }
};