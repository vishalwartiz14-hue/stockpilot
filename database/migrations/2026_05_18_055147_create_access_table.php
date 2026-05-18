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
        Schema::create('access', function (Blueprint $table) {

            $table->id();

            $table->string('module_name', 100)->nullable();

            $table->integer('role')->nullable();

            $table->integer('add')->default(0);

            $table->integer('edit')->default(0);

            $table->integer('delete')->default(0);

            $table->integer('view')->default(0);

            $table->integer('created_by')->nullable();

            $table->timestamp('created_at')->nullable()->useCurrent();

            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access');
    }
};