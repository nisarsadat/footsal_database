<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Hall;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        $hallId = Hall::inRandomOrder()->value('id');
        $customerId = Customer::inRandomOrder()->value('id');






        return [
            'customer_id'=>$customerId,
            'hall_id'=>$hallId,
            'price'=>fake()->numberBetween($min=1,$max=90000),
            'from'=>fake()->time(),
            'to'=>fake()->time(),
            'date'=>fake()->date(),
            'discount'=>fake()->numberBetween($min=1,$max=90000),
            'stuffs_rent'=>fake()->numberBetween($min=1,$max=90000),
            'total'=>fake()->numberBetween($min=1,$max=900000),

            //
        ];
    }
}
