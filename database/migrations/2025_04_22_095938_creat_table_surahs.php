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
        Schema::create('surahs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('surah_number');
            $table->integer('total_verses');
            $table->string('classification');
            $table->string('sub_classification');
            $table->text('description');
            $table->string('summary' , 512);
            $table->json('focus')->nullable();
            $table->json('did_you_know')->nullable();
            $table->json('benefits_of_recitation')->nullable();
            $table->json('selected_ayat')->nullable();
            $table->string('surah_icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suras');
    }
};
