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
        Schema::create('suppliers', function (Blueprint $table) {

            $table->id();

            $table->string('name', 100)->nullable();

            $table->string('company_name', 100)->nullable();

            $table->string('email', 100)->nullable();

            $table->string('phone_number', 100)->nullable();

            $table->enum('status', ['Active', 'Inactive'])->nullable();

            $table->integer('category_id');

            $table->string('delivery_schedule', 100)->nullable();

            $table->string('payment_terms', 1000)->nullable();

            $table->string('street_address', 100)->nullable();

            $table->string('city', 100);

            $table->string('state', 100);

            $table->date('contract_start_date')->nullable();

            $table->date('contract_end_date')->nullable();

            $table->enum('sla_level', ['Standard', 'Premium', 'Enterprise'])->nullable();

            $table->timestamp('created_at')->useCurrent();

            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};