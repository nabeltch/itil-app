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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('id_client');
            $table->foreignId('id_client')->nullable()
            ->constrained('users')
            ->cascadeOnDelete()
            ->nullOnDelete();
            $table->foreignId('id_support')->nullable()
            ->constrained('users')
            ->cascadeOnDelete()
            ->nullOnDelete();
        $table->foreignId('id_purchase')->nullable()
            ->constrained('purchases')
            ->cascadeOnDelete()
            ->nullOnDelete();
        $table->string('client_problem');
        $table->integer('state');
        $table->timestamp('start_time_support')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
