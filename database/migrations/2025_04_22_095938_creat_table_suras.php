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
        Schema::create('suras', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('translation');
            $table->string('classification');
            $table->string('sub_classification');
            $table->string('verses_count');
            $table->string('description');
            $table->string('summary');
            $table->foreignId('theme_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');            $table->string('revelation_order');
            $table->string('sura_color');
            $table->string('sura_icon');
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
