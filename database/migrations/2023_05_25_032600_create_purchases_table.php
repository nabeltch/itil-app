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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->char('code');
            $table->foreignId('id_user')->nullable()
                ->constrained('users')
                ->cascadeOnDelete()
                ->nullOnDelete();
            $table->foreignId('id_product')->nullable()
                ->constrained('products')
                ->cascadeOnDelete()
                ->nullOnDelete();
            $table->integer('quantity');
            $table->float('price');
            $table->float('total');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
