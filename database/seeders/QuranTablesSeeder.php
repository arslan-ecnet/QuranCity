<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class QuranTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Quran Surahs using a reliable public API (AlQuran.cloud)
        // This will automatically fetch and insert all 114 Surahs with accurate basic details!
        $this->command->info('Fetching Surahs from AlQuran Cloud API...');
        
        try {
            $response = Http::timeout(15)->get('https://api.alquran.cloud/v1/surah');
            
            if ($response->successful()) {
                $surahs = $response->json('data');
                $insertData = [];
                
                foreach ($surahs as $surah) {
                    $insertData[] = [
                        'id' => $surah['number'],
                        'name_arabic' => $surah['name'],
                        'name_english' => $surah['englishName'],
                        'name_transliteration' => $surah['englishNameTranslation'],
                        'revelation_type' => strtolower($surah['revelationType']) === 'meccan' ? 'makki' : 'madani',
                        'revelation_order' => null, // The API doesn't provide this, can be updated later
                        'total_verses' => $surah['numberOfAyahs'],
                        'rukus' => null,
                        'hizb_number' => null,
                        'juz_start' => null,
                        'juz_end' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                
                // Truncate first to prevent duplicate entries if run multiple times
                Schema::disableForeignKeyConstraints();
                DB::table('quran_surahs')->truncate();
                DB::table('quran_surahs')->insert($insertData);
                Schema::enableForeignKeyConstraints();
                $this->command->info('Successfully seeded 114 Surahs!');
            } else {
                $this->command->error('Failed to fetch from API. Please check your internet connection.');
            }
        } catch (\Exception $e) {
            $this->command->error('Error fetching Surahs: ' . $e->getMessage());
            
            // Fallback: Seed a few manual ones if the API fails
            DB::table('quran_surahs')->insert([
                [
                    'id' => 1, 'name_arabic' => 'الفاتحة', 'name_english' => 'The Opening', 'name_transliteration' => 'Al-Fatiha',
                    'revelation_type' => 'makki', 'total_verses' => 7, 'created_at' => now(), 'updated_at' => now()
                ],
                [
                    'id' => 2, 'name_arabic' => 'البقرة', 'name_english' => 'The Cow', 'name_transliteration' => 'Al-Baqarah',
                    'revelation_type' => 'madani', 'total_verses' => 286, 'created_at' => now(), 'updated_at' => now()
                ]
            ]);
        }

        $this->command->info('Quran basic tables seeded successfully!');
    }
}
