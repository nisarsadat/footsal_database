<?php

namespace Database\Factories;

use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OwnerPickup>
 */
class OwnerPickupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {




        $ownerId =Owner::inRandomOrder()->value('id');

        return [
            'Owner_id'=>$ownerId,
            'amount'=>fake()->numberBetween($min=1,$max=9000),
            'note'=>fake()->sentence(),
            'date'=>fake()->date(),

        ];
    }
}
