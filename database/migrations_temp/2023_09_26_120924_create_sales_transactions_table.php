<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->decimal('amount', 8, 2);
            $table->unsignedBigInteger('commission_rate_id');
            $table->timestamps();

            $table
                ->foreign('commission_rate_id')
                ->references('id')
                ->on('commission_rates');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_transactions');
    }
};
