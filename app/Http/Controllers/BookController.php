<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class BookController extends Controller
{
    public function index()
    {
     $books = Book::with('genre')->orderBy('title')->paginate(5);

    return view('books.index',[
        'books'=> $books
    ]);
     

    }

    public function create()
    {
        $genres = Genre::all();
        return view('books.create',[
        'genres' => $genres, ]);
    }

    public function store(Request $request)
    {

//   "cover" => null

     $validated = $request->validate([
        'title'=> 'required',
        'author'=> 'required',
        'genre_id' => 'required|exists:genres,id',
        'published_year' => 'required|numeric|digits:4',
        'description'=> 'nullable',

     ]);
      Book::create( $validated );
      return redirect()->route('books.index');
    }

    public function show(Book $book)
    {   
    $book->loadMissing('genre');
    return view('books.show',[
        'book' => $book
        ]);
    }

}

