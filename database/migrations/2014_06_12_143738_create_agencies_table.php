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
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique()->index();
            $table->string('email')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('tax_certificate')->nullable();
            $table->string('contract')->nullable();
            $table->enum('status', \App\Enums\AgencyStatusEnum::values())->default(\App\Enums\AgencyStatusEnum::ACTIVE->value);
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agencies');
    }
};
