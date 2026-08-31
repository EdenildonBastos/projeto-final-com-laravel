<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
// use Illuminate\Validation\Rules\Exists;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
class BookController extends Controller
{ 
    //lista os livros cadastrados no banco de dados e envia para a tela (View)
    public function index()
    {
       //Traz apenas os livros pertencentes ao usuário logado
   // Busca os livros DO USUÁRIO LOGADO, trazendo o gênero, ordenando pelo título e paginando
    //$books = Book::where('user_id', Auth::id())->latest()->get();<-------apagar depois

    $books = Book::with('genre')
        ->where('user_id', Auth::id()) // Filtra apenas os livros do usuário que está logado
        ->orderBy('title')             // Ordena em ordem alfabética por título
        ->paginate(5);                 // Pagina de 5 em 5

    return view('books.index', [
        'books' => $books
    ]);
    

    }
   //Prepara e exibi o formulário de cadastro de um novo livro
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
        'pdf_file'       => 'nullable|mimes:pdf|max:10240', // PDF opcional de até 10MB (10240 KB)
    ]);

        // Grava o ID do usuário atualmente logado via Breeze
      $validated['user_id'] = Auth::id();

    if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
    $file = $request->file('cover');
    // Gera um nome único para o arquivo
    $filename = time() . '_' . $file->getClientOriginalName();
    // Move o arquivo FISICAMENTE para a pasta public/covers
    $file->move(public_path('covers'), $filename);
    // Salva "covers/nome_do_arquivo.jpg" no banco
    $validated['cover'] = 'covers/' . $filename;}

    // Upload do PDF
    if ($request->hasFile('pdf_file') && $request->file('pdf_file')->isValid()) {
        $pdf = $request->file('pdf_file');
        $pdfName = time() . '_' . uniqid() . '.' . $pdf->getClientOriginalExtension();
        
        $destinationPath = public_path('pdfs');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $pdf->move($destinationPath, $pdfName);
        $validated['pdf_file'] = 'pdfs/' . $pdfName;
    }

    Book::create($validated);
    return redirect()->route('books.index')->with('success', 'Livro cadastrado com sucesso!');
} 


      //Exibe os detalhes de um único livro específico
    public function show(Book $book)
    {   
       $book->loadMissing('genre');
        return view('books.show',[
        'book' => $book,
        ]);
    }

     //Responsável por preparar e carregar a tela de edição de um livro existente
    public function edit(Book $book)
    {
         $genres = Genre::all();
         return view('books.edit',[
            'book' => $book,
            'genres' => $genres,
         ]);

    }
    
    //Responsável por atualizar as informações de um livro que já existe no banco de dados
    public function update(Request $request, Book $book)
    {
        // 1. Garante que o usuário só possa editar o PRÓPRIO livro
        if ($book->user_id !== Auth::id()) {
        abort(403, 'Acesso não autorizado.');}

        $validated = $request->validate([
        'title' => 'required',
        'author' => 'required',
        'genre_id' => 'required|exists:genres,id',
        'published_year' => 'required|numeric|digits:4',
        'description' => 'nullable',
        'cover' => 'image|nullable',
        'pdf_file' => 'nullable|mimes:pdf|max:10240',

     ]);

     // 2. Processamento da Capa (Cover)
    if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
        // Apaga a capa antiga se existir fisicamente no disco
        if (!empty($book->cover) && File::exists(public_path($book->cover))) {
            File::delete(public_path($book->cover));
        }

        // Prepara o arquivo novo
        $file = $request->file('cover');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Garante que a pasta public/covers existe
        $destinationPathCovers = public_path('covers');
        if (!File::exists($destinationPathCovers)) {
            File::makeDirectory($destinationPathCovers, 0777, true, true);
        }

        // Move o arquivo para public/covers
        $file->move($destinationPathCovers, $filename);

        // Grava o caminho relativo no array validado: "covers/12345_6789.jpg"
        $validated['cover'] = 'covers/' . $filename;
    } else {
        // Remove a chave para não sobrescrever a capa existente no banco com NULL
        unset($validated['cover']);
    }

     if ($request->hasFile('pdf_file') && $request->file('pdf_file')->isValid()) {
    
    // 1. Apaga o PDF antigo se existir fisicamente no disco
    if (!empty($book->pdf_file) && File::exists(public_path($book->pdf_file))) {
        File::delete(public_path($book->pdf_file));
    }

    // 2. Prepara o arquivo novo
    $pdf = $request->file('pdf_file');
    $pdfName = time() . '_' . uniqid() . '.' . $pdf->getClientOriginalExtension();
    
    // 3. Garante que a pasta public/pdfs existe
    $destinationPath = public_path('pdfs');
    if (!File::exists($destinationPath)) {
        File::makeDirectory($destinationPath, 0777, true, true);
    }

    // 4. Movel o arquivo para public/pdfs
    $pdf->move($destinationPath, $pdfName);

    // 5. Grava o caminho relativo no banco: "pdfs/12345_6789.pdf"
    $validated['pdf_file'] = 'pdfs/' . $pdfName;
} else {
    // Garante que o caminho antigo do PDF no banco não seja sobrescrito com NULL
    unset($validated['pdf_file']);
}
    // Atualiza os dados do livro no banco
    $book->update($validated);

    return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso!');
}
    

public function destroy(Book $book)
{
    // Se existir uma imagem e um pdf cadastrados, apaga do arquivo físico
    if ($book->cover && File::exists(public_path($book->cover))) {
        File::delete(public_path($book->cover));
    }
    if ($book->pdf_file && File::exists(public_path($book->pdf_file))) {
        File::delete(public_path($book->pdf_file));
    }

    $book->delete();

    return redirect()->route('books.index')->with('success', 'Livro excluído com sucesso!');
}

   
    }



