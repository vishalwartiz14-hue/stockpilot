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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();

            $table->string('opening_stock', 100)->nullable();
            $table->string('reorder_level', 100)->nullable();

            $table->unsignedBigInteger('storage_location_id')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamps();

            // Optional foreign keys (if tables exist)
            // $table->foreign('item_id')->references('id')->on('items')->onDelete('set null');
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            // $table->foreign('storage_location_id')->references('id')->on('storage_locations')->onDelete('set null');
            // $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};