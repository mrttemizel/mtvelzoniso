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
            $table->string("basvuru_id");
            $table->string('basvuru_dosya_kontrol_listesi')->nullable();
            $table->string('basvuru_dilekcesi')->nullable();
            $table->string('etik_kurul_basvuru_formu')->nullable();
            $table->string('bilgilendirilmis_gonullu_onam_formu')->nullable();
            $table->string('cocuk_hasta_onam_formu')->nullable();
            $table->string('ebeveyn_onam_formu')->nullable();
            $table->string('saglikli_cocuk_onam_formu')->nullable();
            $table->string('bilgilendirilmis_gonullu_goruntu_ve_ses')->nullable();
            $table->string('ozgecmis')->nullable();
            $table->string('ilgili_abd_bilgilendirme_beyani')->nullable();
            $table->string('covid_genelgesi_taahhutnamesi')->nullable();
            $table->string('biyolojik_meteryal_transfer_formu')->nullable();
            $table->string('multidisipliner_arastirma_onay_formu')->nullable();
            $table->string('degerlendirme_formu')->nullable();
            $table->string('ek_1')->nullable();
            $table->string('ek_2')->nullable();
            $table->string('ek_3')->nullable();
            $table->longText('degerlendirme')->nullable();

            $table->string("basvuru_durumu");

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;

            $table->timestamps();
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
