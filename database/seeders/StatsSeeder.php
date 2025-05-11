<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class StatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //https://stackoverflow.com/questions/19758954/get-data-from-json-file-with-php
        $str = file_get_contents(database_path() . '/seeders/data_source.json');
        $json = json_decode($str, true);

        foreach ($json['data'] as $movie) {
            $totalScore = 0;
            $totalVotes = 0;

            foreach ($movie['reviews'] as $review) {
                $totalScore += $review['score'] * $review['votes'];
                $totalVotes += $review['votes'];
            }
            if($totalVotes > 0){
                $averageScore = $totalScore / $totalVotes;
            }
            else{
                $averageScore = 0;
            }
            DB::table('stats')->insert([
                'film_id' => $movie['id'],
                'average_score' => $averageScore
            ]);
        }
    }
}
