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
            $table->string('name_surname');
            $table->string('nationality');
            $table->string('passport_no');
            $table->string('place_of_birth');
            $table->string('date_of_birth');
            $table->string('passaport_photo');
            $table->string('country');
            $table->text('adress');
            $table->string('phone_number');
            $table->string('email');
            $table->string('high_school');
            $table->string('high_school_country');
            $table->string('high_school_city');
            $table->string('year_of_graduation');
            $table->string('graduation_degree');
            $table->string('official_transcript');
            $table->string('official_exam')->nullable();
            $table->string('preference_one');
            $table->string('preference_two');

            $table->text('information')->nullable();
            $table->text('status')->nullable();



            $table->timestamps();
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
