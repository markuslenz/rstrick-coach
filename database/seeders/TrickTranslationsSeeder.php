<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Trick;
use App\Models\TrickTranslation;

class TrickTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tricks = Trick::all();

        foreach ($tricks as $trick) {
            $trickTranslationDE = new TrickTranslation;

            $trickTranslationDE->trick_id = $trick->id;
            $trickTranslationDE->locale = 'de';
            $trickTranslationDE->name = $trick->name;
            $trickTranslationDE->description = $trick->description;
            $trickTranslationDE->save();

            $trickTranslationEN = new TrickTranslation;

            $trickTranslationEN->trick_id = $trick->id;
            $trickTranslationEN->locale = 'en';
            $trickTranslationEN->name = $trick->name;
            $trickTranslationEN->description = $trick->description;
            $trickTranslationEN->save();
        }
    }
}
