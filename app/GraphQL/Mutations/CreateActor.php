<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Actor;
use App\Models\Film;

final readonly class CreateActor
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $actor = Actor::create([
            'last_name' => $args['last_name'],
            'first_name' => $args['first_name'],
            'birthdate' => $args['birthdate'],
        ]);

        if (!empty($args['films'])) {
            $filmIds = array_map(fn($film) => $film['connect'], $args['films']);
            $actor->films()->attach($filmIds);
        }

        if (!empty($args['films_images'])) {
            foreach ($args['films_images'] as $filmImage) {
                $film = Film::find($filmImage['film_id']);
                if ($film) {
                    $film->image = $filmImage['image'];
                    $film->save();
                }
            }
        }

        return $actor;
    }
}
