<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $rental = Rental::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'rental_date' => Carbon::now(),
            'return_date' => Carbon::now()->addDays(7),
            'status' => 'rented',
        ]);

        return response()->json(['message' => 'Rental created successfully', 'rental_id' => $rental->id]);
    }
}
