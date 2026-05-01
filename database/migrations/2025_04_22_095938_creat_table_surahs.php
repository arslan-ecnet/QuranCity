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
            $table->string('name_arabic')->nullable();
            $table->string('name_english')->nullable();
            $table->string('name_transliteration')->nullable();
            $table->enum('revelation_type', ['makki', 'madani'])->nullable();
            $table->integer('revelation_order')->nullable();
            $table->integer('total_verses')->nullable();
            $table->integer('rukus')->nullable();
            $table->integer('hizb_number')->nullable();
            $table->integer('juz_start')->nullable();
            $table->integer('juz_end')->nullable();
            $table->timestamps();
        });

        Schema::create('verses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surah_id')->constrained('surahs')->onDelete('cascade');
            $table->integer('ayah_number');
            $table->integer('ayah_global_number');
            $table->text('text_arabic')->nullable();
            $table->text('text_simple')->nullable();
            $table->boolean('sajdah')->default(false);
            $table->integer('juz')->nullable();
            $table->integer('hizb')->nullable();
            $table->integer('rub_el_hizb')->nullable();
            $table->integer('page_number')->nullable();
            $table->timestamps();
        });

        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('language');
            $table->string('author')->nullable();
            $table->integer('year')->nullable();
            $table->timestamps();
        });

        Schema::create('verse_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('verse_id')->constrained('verses')->onDelete('cascade');
            $table->foreignId('translation_id')->constrained('translations')->onDelete('cascade');
            $table->text('text');
            $table->timestamps();
        });

        Schema::create('reciters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('style')->nullable();
            $table->timestamps();
        });

        Schema::create('audio_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('verse_id')->constrained('verses')->onDelete('cascade');
            $table->foreignId('reciter_id')->constrained('reciters')->onDelete('cascade');
            $table->string('url');
            $table->integer('duration')->nullable();
            $table->timestamps();
        });


        Schema::create('surah_details', function (Blueprint $table) {
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
        schema::dropIfExists('surah_details');
        Schema::dropIfExists('audio_files');
        Schema::dropIfExists('reciters');
        Schema::dropIfExists('verse_translations');
        Schema::dropIfExists('translations');
        Schema::dropIfExists('verses');
        Schema::dropIfExists('surahs');
    }
};
