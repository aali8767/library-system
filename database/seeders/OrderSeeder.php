<?php

namespace Database\Seeders;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() :void
    {
      
         $faker = Faker::create();
        $user = User::first() ?? User::factory()->create();

        foreach (range(1, 10) as $index) {
            Order::create([
                'user_id' => $user->id,
                'total_price' => $faker->randomFloat(2, 10, 500),
                'status' => $faker->randomElement(['pending', 'completed', 'cancelled']),
            ]);
        }
    }
}
