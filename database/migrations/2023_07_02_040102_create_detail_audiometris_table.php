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
        Schema::create('detail_audiometris', function (Blueprint $table) {
            $table->id();
            $table->integer('audiometri_id');
            $table->integer('deret_id');
            $table->integer('urutan');
            $table->string('posisiTelinga');
            $table->string('isiText');
            $table->string('isiRekamanText');
            $table->string('convertText');
            $table->integer('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_audiometris');
    }
};
