<?php

namespace Database\Seeders;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
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
        $categoryIds = Category::pluck('id')->toArray();

        foreach (range(1, 10) as $index) {
            Book::create([
                'category_id' => $faker->randomElement($categoryIds),
                'user_id' => $user->id,
                'title' => $faker->sentence(3),
                'author' => $faker->name,
                'description' => $faker->paragraph,
                'price' => $faker->randomFloat(2, 5, 100),
                'quantity' => $faker->numberBetween(1, 50),
            ]);
        }
    }
}
