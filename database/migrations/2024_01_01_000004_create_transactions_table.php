<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->onDelete('cascade');
            $table->string('hash', 66)->unique(); // Transaction hashes are 66 characters (including '0x')
            $table->string('from_address', 42);
            $table->string('to_address', 42);
            $table->decimal('value', 36, 18); // Amount of ETH or tokens
            $table->foreignId('token_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('block_number');
            $table->timestamp('transaction_date');
            $table->string('status')->default('success'); // success, failed, pending
            $table->json('raw_data')->nullable(); // Store additional transaction data
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
