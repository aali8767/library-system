<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Book;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        $order = Order::create([
            'user_id' => $request->user_id,
            'total_price' => $book->price,
            'status' => 'pending',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'book_id' => $book->id,
            'quantity' => 1,
            'price' => $book->price,
        ]);

        return response()->json(['message' => 'Order placed successfully', 'order_id' => $order->id]);
    }
}
