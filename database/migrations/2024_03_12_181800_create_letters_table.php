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
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->string('preliminary_acceptance_letter')->nullable();
            $table->text('preliminary_acceptance_letter_information')->nullable();
            $table->string('letter_of_acceptance')->nullable();
            $table->text('letter_of_acceptance_information')->nullable();
            $table->string('receipt')->nullable();
            $table->text('receipt_information')->nullable();

            $table->unsignedBigInteger('form_id')->nullable();
            $table->foreign('form_id')->references('id')->on('forms');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
