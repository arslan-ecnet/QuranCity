<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class TranslationAndAudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Fetching Translations and Audio from AlQuran.cloud API...');
        $this->command->warn('This will download full translations and audio URLs for the entire Quran. Please be patient.');

        Schema::disableForeignKeyConstraints();
        DB::table('verse_translations')->truncate();
        DB::table('audio_files')->truncate();
        DB::table('translations')->truncate();
        DB::table('reciters')->truncate();

        // ---------------------------------------------------------
        // 1. Setup Translations
        // ---------------------------------------------------------
        $editions = [
            [
                'identifier' => 'en.sahih',
                'name' => 'Sahih International',
                'language' => 'en',
                'author' => 'Saheeh International',
                'year' => 1997
            ],
            [
                'identifier' => 'ur.jalandhry',
                'name' => 'Urdu Jalandhry',
                'language' => 'ur',
                'author' => 'Fateh Muhammad Jalandhry',
                'year' => 1900
            ],
            [
                'identifier' => 'sw.barwani',
                'name' => 'Swahili',
                'language' => 'sw',
                'author' => 'Ali Muhsin Al-Barwani',
                'year' => 1995
            ]
        ];

        foreach ($editions as $edition) {
            $this->command->info("Downloading translation: {$edition['name']}...");

            $translationId = DB::table('translations')->insertGetId([
                'name' => $edition['name'],
                'language' => $edition['language'],
                'author' => $edition['author'],
                'year' => $edition['year'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $response = Http::timeout(60)->get("https://api.alquran.cloud/v1/quran/{$edition['identifier']}");
            
            if ($response->successful()) {
                $surahs = $response->json('data.surahs');
                $insertData = [];

                foreach ($surahs as $surah) {
                    foreach ($surah['ayahs'] as $ayah) {
                        $insertData[] = [
                            'verse_id' => $ayah['number'], // Global Ayah Number Maps directly to verses.id since we seeded them in order
                            'translation_id' => $translationId,
                            'text' => $ayah['text'],
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }
                }

                // Insert in chunks of 1000 to prevent database memory issues
                $chunks = array_chunk($insertData, 1000);
                $bar = $this->command->getOutput()->createProgressBar(count($chunks));
                $bar->start();
                foreach ($chunks as $chunk) {
                    DB::table('verse_translations')->insert($chunk);
                    $bar->advance();
                }
                $bar->finish();
                $this->command->info("\nInserted 6236 verses for {$edition['name']}");
            } else {
                $this->command->error("Failed to fetch translation: {$edition['name']}");
            }
        }

        // ---------------------------------------------------------
        // 2. Setup Reciters and Audios
        // ---------------------------------------------------------
        $reciters = [
            [
                'identifier' => 'ar.alafasy',
                'name' => 'Mishary Rashid Alafasy',
                'style' => 'murattal'
            ],
            [
                'identifier' => 'ar.abdulbasitmurattal',
                'name' => 'AbdulBaset AbdulSamad',
                'style' => 'murattal'
            ]
        ];

        foreach ($reciters as $reciter) {
            $this->command->info("Downloading audio links for: {$reciter['name']}...");

            $reciterId = DB::table('reciters')->insertGetId([
                'name' => $reciter['name'],
                'style' => $reciter['style'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $response = Http::timeout(60)->get("https://api.alquran.cloud/v1/quran/{$reciter['identifier']}");

            if ($response->successful()) {
                $surahs = $response->json('data.surahs');
                $insertData = [];

                foreach ($surahs as $surah) {
                    foreach ($surah['ayahs'] as $ayah) {
                        $insertData[] = [
                            'verse_id' => $ayah['number'], // Global Ayah Number Maps directly to verses.id
                            'reciter_id' => $reciterId,
                            'url' => $ayah['audio'],
                            'duration' => null, // The API doesn't provide duration by default
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }
                }

                $chunks = array_chunk($insertData, 1000);
                $bar = $this->command->getOutput()->createProgressBar(count($chunks));
                $bar->start();
                foreach ($chunks as $chunk) {
                    DB::table('audio_files')->insert($chunk);
                    $bar->advance();
                }
                $bar->finish();
                $this->command->info("\nInserted 6236 audio links for {$reciter['name']}");
            } else {
                $this->command->error("Failed to fetch audios for: {$reciter['name']}");
            }
        }

        Schema::enableForeignKeyConstraints();
        $this->command->info('Translations and Audio data successfully seeded via API!');
    }
}
