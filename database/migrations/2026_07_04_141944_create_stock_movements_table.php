<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->enum('type', ['in', 'out', 'adjustment']); // masuk, keluar, penyesuaian (opname)
            $table->string('reference_type', 30); // 'purchase', 'sale', 'opname', 'manual'
            $table->unsignedBigInteger('reference_id')->nullable(); // id dari purchases/sales/stock_opnames
            $table->integer('quantity'); // selalu positif; arah ditentukan oleh 'type'
            $table->integer('stock_before');
            $table->integer('stock_after');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['reference_type', 'reference_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};