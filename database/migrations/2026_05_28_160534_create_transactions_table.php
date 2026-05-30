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
            $table->string('invoice_code', 100)->unique();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->integer('subtotal');
            $table->integer('discount')->default(0);
            $table->integer('total_amount');
            $table->enum('payment_method', ['tunai', 'qris_dummy', 'transfer']);
            $table->timestamps();
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
