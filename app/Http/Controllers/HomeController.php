<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->paginate(12);
        $categories = Category::all();
        return view('home', compact('books', 'categories'));
    }
}
