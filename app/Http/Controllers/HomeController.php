<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $booksCount = Book::count();
        $categoriesCount = Category::count();
        $latestBooks = Book::latest()->take(6)->get(); // عرض آخر 6 كتب فقط

        return view('home', compact('booksCount', 'categoriesCount', 'latestBooks'));
    }
}
