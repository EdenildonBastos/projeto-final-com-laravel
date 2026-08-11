<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Support\Facades\Storage;
class BookController extends Controller
{ 
    //listar os livros cadastrados no banco de dados e enviá-los para a tela (View)
    public function index()
    {
     $books = Book::with('genre')->orderBy('title')->paginate(5);

    return view('books.index',[
        'books'=> $books
    ]);
     

    }
//preparar e exibir o formulário de cadastro de um novo livro
    public function create()
    {
        
        $genres = Genre::all();
        return view('books.create',[
        'genres' => $genres, ]);
    }

   //recebe os dados de um formulário, validá-los, salvar o upload da imagem de capa (se enviada) e cadastrar o novo livro no banco de dados
    public function store(Request $request)
    {

     $validated = $request->validate([
        'title'=> 'required',
        'author'=> 'required',
        'genre_id' => 'required|exists:genres,id',
        'published_year' => 'required|numeric|digits:4',
        'description'=> 'nullable',
         'cover' => 'image|nullable',
         //file aceita qualquer tipo de arquivo

     ]);
     if($request->hasFile('cover') && $request->file('cover')->isValid())
        {$validated['cover']=$request->file('cover')->store();
        }

      Book::create( $validated );
      return redirect()->route('books.index');
    }
      //exibe os detalhes de um único livro específico
    public function show(Book $book)
    {   
    $book->loadMissing('genre');
    return view('books.show',[
        'book' => $book
        ]);
    }
     //responsável por preparar e carregar a tela de edição de um livro existente
    public function edit(Book $book)
    {
         $genres = Genre::all();
         return view('books.edit',[
            'book' => $book,
            'genres' => $genres,
         ]);

    }
    
    //responsável por atualizar as informações de um livro que já existe no banco de dados
    public function update(Book $book, Request $request)
    {
        $validated = $request->validate([
        'title'=> 'required',
        'author'=> 'required',
        'genre_id' => 'required|exists:genres,id',
        'published_year' => 'required|numeric|digits:4',
        'description'=> 'nullable',
         'cover' => 'image|nullable',
         //file aceita qualquer tipo de arquivo

     ]);

     if($request->hasFile('cover') && $request->file('cover')->isValid())
        {
            if($book->cover){
                Storage::delete($book->cover);
            }
            $validated['cover']=$request->file('cover')->store();
        }

      $book->update( $validated );
      return redirect()->route('books.index');

    }

    //responsável por excluir (deletar) um livro do banco de dados
     public function destroy(Book $book)
    {
       $book->delete();
       return redirect()->route('books.index');

    }

}

