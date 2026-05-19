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
        Schema::create('procurement_items', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('procurement_id')->nullable();

            $table->unsignedBigInteger('item_id')->nullable();

            $table->string('unit', 100)->nullable();

            $table->string('quantity', 100)->nullable();

            $table->string('unit_price', 100)->nullable();

            $table->string('total', 100)->nullable();

            $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamp('created_at')->useCurrent();

            $table->timestamp('updated_at')->nullable();

            // Foreign Keys
            $table->foreign('procurement_id')
                  ->references('id')
                  ->on('procurements')
                  ->nullOnDelete();

            $table->foreign('item_id')
                  ->references('id')
                  ->on('items')
                  ->nullOnDelete();

            $table->foreign('created_by')
                  ->references('id')
                  ->on('users')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procurement_items');
    }
};