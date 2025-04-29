<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SurahsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('surahs')->insert([
            'id' => 1,
            'name' => 'AL-BAQARA - THE COW',
            'surah_number' => 2,
            'total_verses' => 286,
            'classification' => 'medinan',
            'sub_classification' => 'madani',
            'description' => "It is the longest chapter of the Qur’an and opens with the answer to the question in Sura Al Fatiha of “Guide us on the right way” stating that this is the guidance for the God conscious.\nIt begins with the categorisation of belief into those who believe in the seen and unseen, all the Prophets and the imperative to give followed by those who cover up the truth and then hypocrisy.\nThen starts a historical journey of belief from the creation of Prophet Adam and the refusal of Shaitan to obey the order of Divinity to prostrate to him.\nThis is followed by the history of the children of Israail; the numerous blessings given to them and milestone events in their history.\nProphet Ibraheem is discussed next in his establishment of the Ka’ba and his prayer for peace, prosperity, a Prophet from his progeny. The change of qibla from Jerusalem to the Ka’ba follows and then important practical laws are legislated in this chapter.\nLong term financial investments of condition free loans to humanity, charity without reproach and the chief of the verses of the Qur’an – Ayatul Kursi follow. Here the awesomeness of Allah is described.\nThe chapter ends with a re-iteration of core beliefs and a prayer of forgiveness, protection and help to maintain them.",
            'summary' => 'TIMELESS RESPONSE TO REQUEST FOR GUIDANCE IN SURATUL FATIHA UNDERSTANDING FAITH THROUGH HISTORY GUIDANCE THROUGH PRACTICAL LAWS AND DIRECTIVES FROM DIVINITY COVERING ALL MATTERS AYATUL KURSI - AWESOMENESS OF ALLAH',
            'focus' => json_encode([
                "TIMELESS RESPONSE TO REQUEST FOR GUIDANCE IN SURATUL FATIHA",
                "UNDERSTANDING FAITH THROUGH HISTORY",
                "GUIDANCE THROUGH PRACTICAL LAWS AND DIRECTIVES",
                "FROM DIVINITY COVERING ALL MATTERS",
                "AYATUL KURSI - AWESOMENESS OF ALLAH"
            ]),
            'did_you_know' => json_encode([
                "IT IS THE LONGEST SURA OF THE QUR'AN COMPRISING ONE TWELFTH OF THE ENTIRE TEXT \"EVERYTHING HAS A ZENITH AND THE ZENITH OF THE QUR'AN IS SURATUL BAQARA AND IN IT IS THE BEST OF VERSES – AYATUL KURSI (THE VERSE OF THE THRONE). HOLDING TO IT IS A BLESSING AND LEAVING IT IS AN AFFLICTION\" Prophet Muhammad (pbuh)"
            ]),
            'benefits_of_recitation' => json_encode([
                "Ayaat 72-73 for chest pains",
                "Aya 107 3x for shoulders",
                "Ayatul Kursi for eyes",
                "Aya 165 on sweet and feed a displeased person",
                "Life, property & family protected if recite first 4 ayaat + Ayatul Kursi + last 3 ayaat",
                "Shade on Qiyama if recited with Aali Imran"
            ]),
            'selected_ayat' => json_encode([
                ['ayat' => '2:129', 'summary' => 'Dua of Prophet Ibraheem (pbuh) answered 2:186 Dua in 62:2'],
                ['ayat' => '2:148', 'summary' => 'Direction (Goal)'],
                ['ayat' => '2:156', 'summary' => 'Indeed we are from Allah and to Him we shall surely return'],
                ['ayat' => '2:158', 'summary' => 'Safa and Marwa'],
                ['ayat' => '2:173', 'summary' => 'Forbidden meat'],
                ['ayat' => '2:201', 'summary' => 'Dua for good in the world and the hereafter 2:207 Ali (pbuh) in hijra'],
                ['ayat' => '2:219', 'summary' => 'Intoxicants and gambling'],
                ['ayat' => '2:222', 'summary' => 'Menstruation'],
                ['ayat' => '2:255', 'summary' => 'Ayatul Kursi Aya of the throne(Sayyidul Ayaat - Leader of all the ayaat)'],
                ['ayat' => '2:285', 'summary' => 'Aamanar Rasul'],
                ['ayat' => '2:177', 'summary' => 'Ayatul Birr What it means to be a good person'],
                ['ayat' => '2:264', 'summary' => 'Charity'],
                ['ayat' => '2:144', 'summary' => 'Qibla'],
                ['ayat' => '2:183', 'summary' => 'Fasting (Sawm)'],
            ]),
            'surah_icon' => 'surah_icon/VBCc4kXYoyIM3Gbkv3MQLkDHRm9d7hFO2e9TAW3w.png',
            'created_at' => '2025-04-26 07:42:22',
            'updated_at' => '2025-04-26 07:42:22',
        ]);
    }
}
