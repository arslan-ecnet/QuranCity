<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quran_surahs', function (Blueprint $table) {
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
            $table->foreignId('surah_id')->constrained('quran_surahs')->onDelete('cascade');
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

        Schema::table('bookmarks', function (Blueprint $table) {
            $table->foreignId('verse_id')->nullable()->constrained('verses')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('bookmarks', function (Blueprint $table) {
            $table->dropForeign(['verse_id']);
            $table->dropColumn('verse_id');
        });
        Schema::dropIfExists('audio_files');
        Schema::dropIfExists('reciters');
        Schema::dropIfExists('verse_translations');
        Schema::dropIfExists('translations');
        Schema::dropIfExists('verses');
        Schema::dropIfExists('quran_surahs');
    }
};
