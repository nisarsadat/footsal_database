<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $bookingId =Booking::inRandomOrder()->value('id');

        return [

            'booking_id'=>$bookingId,
            'payed'=>fake()->numberBetween($min=1,$max=10000),
            'date'=>fake()->date()
            //
        ];
    }
}
