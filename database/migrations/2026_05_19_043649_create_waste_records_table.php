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
        Schema::create('waste_records', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->enum('waste_type', [
                'expired_inventory',
                'kitchen_waste',
                'spoilage',
                'plate_waste',
                'damaged_inventory',
            ])->nullable();

            $table->string('unit', 100)->nullable();

            $table->string('quantity', 100)->nullable();

            $table->string('item_price', 100)->nullable();

            $table->string('cost', 100)->nullable();

            $table->longText('notes')->nullable();

            $table->date('waste_date')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamp('created_at')->useCurrent();

            $table->timestamp('updated_at')->nullable();

            // Foreign Keys
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
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
        Schema::dropIfExists('waste_records');
    }
};