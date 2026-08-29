<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
// use Illuminate\Validation\Rules\Exists;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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

    public function store(Request $request)
{
    $validated = $request->validate([
        'title'          => 'required',
        'author'         => 'required',
        'genre_id'       => 'required|exists:genres,id',
        'published_year' => 'required|numeric|digits:4',
        'description'    => 'nullable',
        'cover'          => 'required|image',
    ]);

    if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
    $file = $request->file('cover');
    // Gera um nome único para o arquivo
    $filename = time() . '_' . $file->getClientOriginalName();
    
    // Move o arquivo FISICAMENTE para a pasta public/covers
    $file->move(public_path('covers'), $filename);
    
    // Salva "covers/nome_do_arquivo.jpg" no banco
    $validated['cover'] = 'covers/' . $filename;}

    Book::create($validated);

    return redirect()->route('books.index');
}

      //exibe os detalhes de um único livro específico
    public function show(Book $book)
    {   
       $book->loadMissing('genre');
        return view('books.show',[
        'book' => $book,
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

     if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
        
        // APAGA A IMAGEM ANTIGA SE ELA EXISTIR NO DISCO
        if ($book->cover && File::exists(public_path($book->cover))) {
            File::delete(public_path($book->cover));
        }

        // SALVA A NOVA IMAGEM
        $file = $request->file('cover');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('covers');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $file->move($destinationPath, $filename);

        // Atualiza o caminho da nova capa na array validada
        $validated['cover'] = 'covers/' . $filename;
    }

    // 3. Atualiza os dados do livro no banco
    $book->update($validated);

    return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso!');
}

public function destroy(Book $book)
{
    // Se existir uma imagem cadastrada, apaga do arquivo físico
    if ($book->cover && File::exists(public_path($book->cover))) {
        File::delete(public_path($book->cover));
    }

    $book->delete();

    return redirect()->route('books.index')->with('success', 'Livro excluído com sucesso!');
}

   
    }



