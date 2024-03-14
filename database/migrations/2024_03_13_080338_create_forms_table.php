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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('basvuru_id')->nullable();

            $table->string('name_surname')->nullable();
            $table->string('nationality')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('passport_photo')->nullable();

            $table->string('country')->nullable();
            $table->longText('adress')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('high_school')->nullable();
            $table->string('high_school_country')->nullable();
            $table->string('high_school_city')->nullable();

            $table->date('year_of_graduation')->nullable();
            $table->string('graduation_degree')->nullable();
            $table->string('official_transcript')->nullable();
            $table->string('official_exam')->nullable();

            $table->text('information')->nullable();
            $table->text('status')->nullable();
            $table->timestamps();


            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('section_id')->references('id')->on('sections');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
