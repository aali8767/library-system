<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RentalController extends Controller
{
    public function index()
{
    $rentals = Rental::with(['user', 'book'])->latest()->paginate(10);
    return view('admin.rentals', compact('rentals'));
}

    public function store(Request $request)
    {
        $book = Book::findOrFail($request->book_id);

        Rental::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'rental_date' => Carbon::now(),
            'return_date' => Carbon::now()->addDays(7),
            'status' => 'rented',
        ]);

        return response()->json(['message' => '✅ تم إضافة الإيجار بنجاح.']);
    }
}
