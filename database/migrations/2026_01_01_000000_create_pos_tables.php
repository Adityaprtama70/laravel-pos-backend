<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('outlets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        $tables = [
            'business_settings', 'suppliers', 'purchase_orders', 'stocks', 'stock_transfers', 'stock_histories',
            'products', 'categories', 'product_variants', 'orders', 'customers', 'order_payments',
            'cash_drawer_sessions', 'cash_transactions', 'promotions', 'vouchers', 'activity_logs'
        ];
        foreach ($tables as $table) {
            Schema::create($table, function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('outlets');
        // Drop others...
    }
};
