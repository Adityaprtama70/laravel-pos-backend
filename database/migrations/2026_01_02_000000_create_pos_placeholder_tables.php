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
        $tables = [
            'business_settings',
            'suppliers',
            'purchase_orders',
            'stocks',
            'stock_transfers',
            'stock_histories',
            'products',
            'categories',
            'product_variants',
            'orders',
            'customers',
            'order_payments',
            'cash_drawer_sessions',
            'cash_transactions',
            'promotions',
            'vouchers',
            'activity_logs'
        ];

        foreach ($tables as $table) {
            Schema::create($table, function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable(); // Generic field for display
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'business_settings',
            'suppliers',
            'purchase_orders',
            'stocks',
            'stock_transfers',
            'stock_histories',
            'products',
            'categories',
            'product_variants',
            'orders',
            'customers',
            'order_payments',
            'cash_drawer_sessions',
            'cash_transactions',
            'promotions',
            'vouchers',
            'activity_logs'
        ];

        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
    }
};
