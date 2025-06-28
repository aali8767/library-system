<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return response()->json(Book::with('category')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $book = Book::create($validated);
        return response()->json(['message' => 'Book created', 'book' => $book]);
    }

    public function show($id)
    {
        $book = Book::with('category')->find($id);
        if ($book) {
            return response()->json($book);
        }
        return response()->json(['message' => 'Book not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $validated = $request->validate([
            'title' => 'sometimes|required',
            'author' => 'sometimes|required',
            'description' => 'nullable',
            'price' => 'sometimes|required|numeric',
            'quantity' => 'sometimes|required|integer',
            'category_id' => 'sometimes|required|exists:categories,id',
            'user_id' => 'sometimes|required|exists:users,id'
        ]);
        $book->update($validated);
        return response()->json(['message' => 'Book updated', 'book' => $book]);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(['message' => 'Book deleted']);
    }

    public function search(Request $request)
    {
        $keyword = $request->query('q');
        $books = Book::where('title', 'like', "%$keyword%")
                      ->orWhere('author', 'like', "%$keyword%")
                      ->get();
        return response()->json($books);
    }

    public function booksByCategory($categoryId)
    {
        $books = Book::where('category_id', $categoryId)->get();
        return response()->json($books);
    }

public function mostExpensive()
{
    $book = Book::orderBy('price', 'desc')->first();

    if (!$book) {
        return response()->json(['message' => 'No books found'], 404);
    }

    return response()->json($book);
}



    public function statistics()
    {
        $count = Book::count();
        $averagePrice = Book::average('price');
        $totalQuantity = Book::sum('quantity');

        return response()->json([
            'total_books' => $count,
            'average_price' => $averagePrice,
            'total_quantity' => $totalQuantity
        ]);
    }

    public function latest()
    {
        $books = Book::latest()->take(10)->get();
        return response()->json($books);
    }
}
