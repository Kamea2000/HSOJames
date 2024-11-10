<?php

// database/migrations/YYYY_MM_DD_create_transactions_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->decimal('total', 10, 2);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->json('cart_items'); // Store cart items as JSON
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}

