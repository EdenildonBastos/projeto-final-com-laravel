<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    // {
    //     $books = Book::all();

    //     return view('dashboard', [
    //         'books' => $books
    //     ]);
    // }
    {
        // Busca APENAS os livros cadastrados pelo usuário autenticado no momento
        $books = Book::where('user_id', Auth::id())
                    ->latest() // Ordena dos mais recentes para os mais antigos
                    ->get();

        return view('dashboard', [
            'books' => $books
        ]);
    }
}
