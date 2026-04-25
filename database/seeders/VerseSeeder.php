<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class VerseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Fetching all 6236 Verses from AlQuran Cloud API...');
        $this->command->warn('This might take a couple of minutes to download everything...');

        Schema::disableForeignKeyConstraints();
        DB::table('verses')->truncate();

        $totalSurahs = 114;
        
        // Setup progress bar
        $bar = $this->command->getOutput()->createProgressBar($totalSurahs);
        $bar->start();

        for ($i = 1; $i <= $totalSurahs; $i++) {
            // Fetch Uthmani script and Simple text in a single API call for the Surah
            $response = Http::timeout(30)->get("https://api.alquran.cloud/v1/surah/{$i}/editions/quran-uthmani,quran-simple");
            
            if ($response->successful()) {
                $editions = $response->json('data');
                $uthmaniAyahs = $editions[0]['ayahs'];
                $simpleAyahs = $editions[1]['ayahs'];
                
                $insertData = [];
                
                foreach ($uthmaniAyahs as $index => $ayah) {
                    // Check if sajdah is true or an array containing sajdah info
                    $sajdah = $ayah['sajda'];
                    $isSajdah = is_array($sajdah) ? true : (bool) $sajdah;

                    // Calculate Hizb number from HizbQuarter (1 to 240)
                    $hizbQuarter = $ayah['hizbQuarter'] ?? null;
                    $hizb = $hizbQuarter ? ceil($hizbQuarter / 4) : null;

                    $insertData[] = [
                        'surah_id' => $i,
                        'ayah_number' => $ayah['numberInSurah'],
                        'ayah_global_number' => $ayah['number'],
                        'text_arabic' => $ayah['text'],
                        'text_simple' => $simpleAyahs[$index]['text'],
                        'sajdah' => $isSajdah,
                        'juz' => $ayah['juz'] ?? null,
                        'hizb' => $hizb,
                        'rub_el_hizb' => $hizbQuarter,
                        'page_number' => $ayah['page'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                
                // Chunk insertion to be safe, though a single Surah won't exceed DB limits
                DB::table('verses')->insert($insertData);
                
            } else {
                $this->command->error("\nFailed to fetch verses for Surah {$i}. Retrying...");
                sleep(2);
                $i--; // Retry this surah
            }
            
            $bar->advance();
            // Small delay to respect API rate limits
            usleep(200000); // 200ms
        }
        
        $bar->finish();
        Schema::enableForeignKeyConstraints();
        $this->command->info("\nAll verses seeded successfully!");
    }
}
