<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Musteriler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Musteriler', function (Blueprint $table) {
            $table->id();
            $table->string('Unvan');
            $table->string('YetkiliAdSoyad');
            $table->string('VergiNumarasi');
            $table->string('VergiDairesi');
            $table->string('Telefon');
            $table->string('EMail');
            $table->string('Il');
            $table->string('Ilce');
            $table->longText('adres')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Musteriler');
    }
}
