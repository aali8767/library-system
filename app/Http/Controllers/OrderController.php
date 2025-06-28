<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
{
    $orders = Order::with(['user', 'orderItems.book'])->latest()->paginate(10);
    return view('admin.orders', compact('orders'));
}

    public function store(Request $request)
    {
        $book = Book::findOrFail($request->book_id);

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $book->price,
            'status' => 'pending',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'book_id' => $book->id,
            'quantity' => 1,
            'price' => $book->price,
        ]);
        

        return response()->json(['message' => '✅ تم إضافة الطلب بنجاح.']);
    }
}
