<?php

namespace Database\Seeders;
use App\Models\Rental;
use App\Models\User;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $user = User::first() ?? User::factory()->create();
        $bookIds = Book::pluck('id')->toArray();

        foreach (range(1, 10) as $index) {
            Rental::create([
                'user_id' => $user->id,
                'book_id' => $faker->randomElement($bookIds),
                'rental_date' => Carbon::now()->subDays($faker->numberBetween(1, 30)),
                'return_date' => Carbon::now()->addDays($faker->numberBetween(1, 15)),
                'status' => $faker->randomElement(['rented', 'returned']),
            ]);
        }
    }
}
