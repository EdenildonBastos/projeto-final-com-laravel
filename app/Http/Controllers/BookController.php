<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
       $books = Book::all();

    return view('books.index',['books'=> $books]);

    }
    public function show($id)
    {
         $book = Book::findOrFail($id);
    // findOrFail= busca um registro no banco de dados pela chave primária (ID). Se o registro existir, ele retorna os dados. Se não encontrar, ele para a execução e dispara automaticamente uma exceção de erro HTTP 404 (página não encontrada)
    return view('books.show',['book' => $book]);

    }
}
