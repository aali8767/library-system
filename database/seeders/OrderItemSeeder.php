<?php

namespace Database\Seeders;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $faker = Faker::create();
        $orderIds = Order::pluck('id')->toArray();
        $bookIds = Book::pluck('id')->toArray();

        foreach (range(1, 10) as $index) {
            OrderItem::create([
                'order_id' => $faker->randomElement($orderIds),
                'book_id' => $faker->randomElement($bookIds),
                'quantity' => $faker->numberBetween(1, 5),
                'price' => $faker->randomFloat(2, 10, 100),
            ]);
        }
    }
}
