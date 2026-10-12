<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number', 50)->unique(); // No. Transaksi, contoh: INV-20260704-0001
            $table->foreignId('customer_id')->nullable()
                ->constrained('customers')->nullOnDelete(); // null = pelanggan umum/walk-in
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // kasir
            $table->dateTime('sale_date');
            $table->unsignedBigInteger('total_amount')->default(0); // sebelum diskon/pajak
            $table->unsignedBigInteger('discount')->default(0);
            $table->unsignedBigInteger('tax')->default(0);
            $table->unsignedBigInteger('grand_total')->default(0); // total - diskon + pajak
            $table->unsignedBigInteger('paid_amount')->default(0);
            $table->unsignedBigInteger('change_amount')->default(0);
            $table->enum('payment_method', ['cash', 'transfer', 'qris', 'debit'])->default('cash');
            $table->enum('status', ['completed', 'cancelled'])->default('completed');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};