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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number')->unique();
            $table->date('transaction_date');
            $table->text('description');
            $table->string('reference')->nullable();
            $table->decimal('total_amount', 15, 2);
            $table->enum('status', ['pending', 'posted', 'reversed'])->default('posted');
            $table->timestamps();
            
            $table->index(['transaction_date', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};