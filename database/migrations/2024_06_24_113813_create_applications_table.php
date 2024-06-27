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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('nationality_id');
            $table->unsignedBigInteger('school_country_id');
            $table->unsignedBigInteger('department_id');
            $table->string('application_id');
            $table->string('name');
            $table->string('passport_number');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('passport_photo')->nullable();
            $table->text('address');
            $table->string('phone_number');
            $table->string('email');
            $table->string('school_name');
            $table->string('school_city');
            $table->date('year_of_graduation');
            $table->string('graduation_degree');
            $table->string('official_transcript')->nullable();
            $table->string('document_file')->nullable();
            $table->string('payment_file')->nullable();
            $table->string('reference');
            $table->enum('status', \App\Enums\ApplicationStatusEnum::values())->default(\App\Enums\ApplicationStatusEnum::PENDING->value);
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
