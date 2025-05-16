<?php

namespace App\GraphQL\Mutations;

use App\Models\Stat;
use App\Models\Critic;

class CreateCritic
{
    public function __invoke($_, array $args)
    {

        $critic = Critic::create([
            'score' => $args['score'],
            'comment' => $args['comment'],
            'film_id' => $args['film_id'],
            'user_id' => $args['user_id'],
        ]);

        $stat = Stat::where('film_id', $args['film_id'])->firstOrFail();

        $newTotalVote = $stat->total_votes + 1;
        $newTotalScore = ($stat->average_score * $stat->total_votes) + $args['score'];
        $newAverageScore = $newTotalScore / $newTotalVote;

        $stat->average_score = $newAverageScore;
        $stat->total_votes = $newTotalVote;
        $stat->save();

        return $stat;
    }
}