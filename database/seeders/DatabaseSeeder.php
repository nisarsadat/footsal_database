<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Customer::factory(3)->create();
        \App\Models\Hall::factory(3)->create();
        \App\Models\Booking::factory(3)->create();
        \App\Models\Payment::factory(3)->create();
        \App\Models\ExpenseCatagory::factory(3)->create();
        \App\Models\Expense::factory(3)->create();
        \App\Models\Owner::factory(3)->create();
        \App\Models\OwnerPickup::factory(3)->create();
        \App\Models\Gymnasium::factory(3)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
