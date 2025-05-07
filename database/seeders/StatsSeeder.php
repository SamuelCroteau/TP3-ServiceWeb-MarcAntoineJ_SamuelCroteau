<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //TODO faire calcul de moyenne pour chaque film et mettre dans stats
        $nbVotes = 0;
        $totalScore = 0;
        $str = file_get_contents(database_path() . '/seeders/data_source.sql');
        $json = json_decode($str, true); //https://stackoverflow.com/questions/19758954/get-data-from-json-file-with-php
        foreach ($json['data']['reviews'] as $field => $value) {
            //ptet mettre autre boucle, jpense c good tho
            $currentNbVotes = $json['data']['reviews']/*[0]*/['votes'];
            $currentScore = $json['data']['reviews']/*[0]*/['score'];
            $nbVotes += $currentNbVotes;
            $totalScore += $currentScore;
        }
        $averageScore = $totalScore / $nbVotes;

    {

        DB::table('stats')->insert([

            'name' => Str::random(10),

            'email' => Str::random(10).'@example.com',

            'password' => Hash::make('password'),

        ]);
    }
}
