<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MatchSeeder extends Seeder
{
    public function run()
    {
        DB::table('matches')->insert([
            [
                'home_team' => 'Tottenham Hotspurs',
                'away_team' => 'Arsenal',
                'match_time' => '2023-05-28 20:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

