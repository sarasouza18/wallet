<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('wallet_id')->references('id')->on('wallets');
            $table->foreignUuid('wallet_payee_id')->references('id')->on('wallets');
            $table->foreignId('type_id')->references('id')->on('transaction_types');
            $table->foreignId('status_id')->references('id')->on('transaction_statuses');
            $table->float('amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
