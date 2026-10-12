<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku', 50)->unique();       // Kode internal produk
            $table->string('barcode', 100)->nullable()->unique();
            $table->string('name', 200);
            $table->foreignId('category_id')->nullable()
                ->constrained('categories')->nullOnDelete();
            $table->foreignId('supplier_id')->nullable()
                ->constrained('suppliers')->nullOnDelete();
            $table->string('unit', 20)->default('pcs'); // satuan: pcs, sak, batang, m2, kg, dll
            $table->unsignedBigInteger('purchase_price')->default(0); // harga beli terakhir
            $table->unsignedBigInteger('selling_price')->default(0);  // harga jual
            $table->integer('stock')->default(0);
            $table->integer('min_stock')->default(5); // ambang batas stok hampir habis
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};