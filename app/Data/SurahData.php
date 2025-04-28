<?php

namespace App\Data;

class SurahData
{
    public function __construct(
        public int    $id,
        public string $name,
        public string $surah_number,
        public string $total_verses,
        public string $classification,
        public string $sub_classification,
        public string $description,
        public string $summary,
        public string $surah_icon,
        public array $focus,
        public array $did_you_know,
        public array $benefits_of_recitation,
        public array $selected_ayat,
        public array $surah_details,
        public array $bookmark,
    )
    {
    }
}
