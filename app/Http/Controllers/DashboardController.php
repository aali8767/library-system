<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Order;
use App\Models\Rental;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $booksCount = Book::count();
        $ordersCount = Order::count();
        $rentalsCount = Rental::count();

        // جلب البيانات الشهرية لآخر 6 أشهر
        $months = collect(range(0, 5))->map(function ($i) {
            return Carbon::now()->subMonths($i)->format('Y-m');
        })->reverse();

        $booksPerMonth = $months->map(function ($month) {
            return Book::whereYear('created_at', substr($month, 0, 4))
                       ->whereMonth('created_at', substr($month, 5, 2))
                       ->count();
        });

        $ordersPerMonth = $months->map(function ($month) {
            return Order::whereYear('created_at', substr($month, 0, 4))
                        ->whereMonth('created_at', substr($month, 5, 2))
                        ->count();
        });

        $rentalsPerMonth = $months->map(function ($month) {
            return Rental::whereYear('created_at', substr($month, 0, 4))
                         ->whereMonth('created_at', substr($month, 5, 2))
                         ->count();
        });

        return view('dashboard', compact(
            'usersCount',
            'booksCount',
            'ordersCount',
            'rentalsCount',
            'months',
            'booksPerMonth',
            'ordersPerMonth',
            'rentalsPerMonth'
        ));
    }
}
