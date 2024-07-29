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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('nationality_id')->nullable();
            $table->unsignedBigInteger('school_country_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('code')->index();
            $table->string('name')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('passport_photo')->nullable();
            $table->text('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('school_name')->nullable();
            $table->string('school_city')->nullable();
            $table->date('year_of_graduation')->nullable();
            $table->string('graduation_degree')->nullable();
            $table->string('official_transcript')->nullable();
            $table->string('official_exam')->nullable();
            $table->string('payment_file')->nullable();
            $table->string('high_school_diploma')->nullable();
            $table->string('additional_document')->nullable();
            $table->string('missing_document_description')->nullable();
            $table->string('reference')->nullable();
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
