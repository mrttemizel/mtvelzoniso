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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('faculty')->nullable();
            $table->string('name');
            $table->double('annual_fee')->default(0);
            $table->double('discounted_fee')->default(0);
            $table->enum('status', \App\Enums\DepartmentStatusEnum::values())->default(\App\Enums\DepartmentStatusEnum::ACTIVE->value);
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
