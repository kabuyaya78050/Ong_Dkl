<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->string('payment_method_new')
                ->nullable()
                ->after('amount');
        });

        if (DB::getDriverName() === 'sqlite') {
            foreach (DB::table('donations')->get(['id', 'payment_method']) as $donation) {
                DB::table('donations')
                    ->where('id', $donation->id)
                    ->update([
                        'payment_method_new' => $donation->payment_method,
                    ]);
            }
        } else {
            DB::table('donations')->update([
                'payment_method_new' => DB::raw('payment_method::text'),
            ]);
        }

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

        if (DB::getDriverName() === 'sqlite') {
            foreach (DB::table('donations')->get(['id', 'payment_method']) as $donation) {
                DB::table('donations')
                    ->where('id', $donation->id)
                    ->update([
                        'payment_method_old' => $donation->payment_method,
                    ]);
            }
        } else {
            DB::table('donations')->update([
                'payment_method_old' => DB::raw('payment_method'),
            ]);
        }

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