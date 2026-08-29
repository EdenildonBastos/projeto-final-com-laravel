<?php
use App\Models\Book; 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;



//MVC--> Model, View, Controller

//rota para a página inicial do site
Route::get('/', function () {
    return view('welcome');
});

// inicio das rotas de implementação

// rota para a página do dashboard(substituindo a rota  index)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/livros', [BookController::class, 'index'])
    ->name('books.index');

Route::get('livros/criar', [BookController::class, 'create'])
->name('books.create');

//cria requisição post que vem do formulário.
Route::post('livros/criar', [BookController::class, 'store'])
->name('books.store');


Route::get('/livros/{book}',[BookController::class, 'show'])
->name('books.show');

Route::put('/livros/{book}',[BookController::class, 'update'])
->name('books.update');

Route::delete('/livros/{book}',[BookController::class, 'destroy'])
->name('books.destroy');

Route::get('/livros/{book}/editar',[BookController::class, 'edit'])
->name('books.edit');
//fim das rotas de implementação

//gerencia todas as rotas de autenticação de uma aplicação Laravel (é o arquivo padrão gerado por pacotes como o Laravel Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Burlar o atalho do Windows e servir as imagens direto do storage/app/public
// Route::get('/storage/covers/{filename}', function ($filename) {
//     // Caminho absoluto exato do arquivo no Windows
//     $path = storage_path('app/public/covers/' . $filename);

//     if (!file_exists($path)) {
//         abort(404);
//     }

//     $file = file_get_contents($path);
//     $type = mime_content_type($path);

//     return response($file, 200)->header("Content-Type", $type);
// });

require __DIR__.'/auth.php';
