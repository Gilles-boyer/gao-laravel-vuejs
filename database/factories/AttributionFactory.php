<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Computer;
use App\Models\Attribution;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AttributionFactory extends Factory
{
    use DatabaseMigrations;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attribution::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $client =Client::factory();
        return [
            'id'          => 1,
            'date'        => "2020-11-15",
            'time'        => $this->faker->numberBetween(8,18),
            'client_id'   =>  $client,
        ];
    }
}
