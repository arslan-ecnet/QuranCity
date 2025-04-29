<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SurahDetailSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        DB::table('surah_details')->insert([
            [
                'id' => 1,
                'surah_id' => 1,
                'theme_id' => 5,
                'from' => 284,
                'to' => 286,
                'title' => 'Core beliefs reiterated and prayer to maintain them',
                'summary' => json_encode([
                    'Belief in Allah, angels, books & prophets with a declaration of "We believe and we obey" The prayer asks for forgiveness, protection, and help'
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'surah_id' => 1,
                'theme_id' => 2,
                'from' => 243,
                'to' => 283,
                'title' => 'Ayatul Kursi 255 (Verse of the Throne) Long-term investments Lessons from past Prophets',
                'summary' => json_encode([
                    '(Ibraheem, Dawood & Uzayr)'
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'surah_id' => 1,
                'theme_id' => 4,
                'from' => 153,
                'to' => 242,
                'title' => 'Ayatul Birr - aya 177',
                'summary' => json_encode([
                    'Food', 'Hajj', 'Evidence Charity', 'Self defence, retribution', 'Wills',
                    'Fasting Ramadhanan', 'Marriage, nursing, divorce, alimony Orphans, widows',
                    'Drinking gambling bribery', 'Menstruation', 'Oaths'
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'surah_id' => 1,
                'theme_id' => 8,
                'from' => 142,
                'to' => 152,
                'title' => 'CHANGE OF QIBLA AND INAUGURATION OF A NEW MIDDLE NATION (UMMA)',
                'summary' => json_encode([]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'surah_id' => 1,
                'theme_id' => 5,
                'from' => 124,
                'to' => 141,
                'title' => 'PROPHET IBRAHEEM',
                'summary' => json_encode([
                    'The prayers of Prophet Ibraheem with a focus on Peace, Prosperity, Progeny and Prophet (Guidance)'
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'surah_id' => 1,
                'theme_id' => 8,
                'from' => 40,
                'to' => 123,
                'title' => 'THE HISTORY OF THE CHILDREN OF ISRAAIL',
                'summary' => json_encode([
                    '40-47 Reminder of the blessings bestowed on the children of Israail',
                    '48-74 Milestone events from the history of the children of Israail',
                    '75-123 History of the children of Israail to current state'
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 7,
                'surah_id' => 1,
                'theme_id' => 5,
                'from' => 30,
                'to' => 39,
                'title' => 'CREATION OF PROPHET ADAM',
                'summary' => json_encode([
                    'Refusal of Shaitan to obey Divinity and his deceit towards Prophet Adam & Sayyida Hawwa'
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 8,
                'surah_id' => 1,
                'theme_id' => 2,
                'from' => 21,
                'to' => 29,
                'title' => 'INTRODUCTION TO THE CREATOR AND AUTHENTICITY OF THE QURAN',
                'summary' => json_encode([
                    'Invitation to be His slave'
                ]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 9,
                'surah_id' => 1,
                'theme_id' => 7,
                'from' => 1,
                'to' => 20,
                'title' => 'A SUMMARY OF THE QUALITIES OF BELIEVERS, THOSE WHO COVER UP THE TRUTH AND HYPOCRITES',
                'summary' => json_encode([]),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
