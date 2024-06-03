<?php

namespace Database\Factories;

use App\Models\ExpenseCatagory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        $expenseCatagoryId =ExpenseCatagory::inRandomOrder()->value('id');

        return [
            'expense_catagory_id'=>$expenseCatagoryId,
            'amount'=>fake()->numberBetween($min=1,$max=9000),
            'note'=>fake()->sentence(),
            'date'=>fake()->date(),

        ];
    }
}
