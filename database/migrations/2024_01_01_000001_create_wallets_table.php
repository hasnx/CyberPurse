<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->string('address', 42)->unique(); // Ethereum addresses are 42 characters (including '0x')
            $table->string('name')->nullable(); // Optional user-given name for the wallet
            $table->decimal('eth_balance', 36, 18)->default(0); // Ethereum has 18 decimal places
            $table->timestamp('last_checked_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wallets');
    }
};
