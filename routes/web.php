<?php
use App\Models\Book; 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

//rota para a página inicial do site
Route::get('/', function () {
    return view('welcome');
});

// rota para a página do dashboard(substituindo a rota  index)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// inicio das rotas de implementação

Route::get('/livros', [BookController::class, 'index'])
    ->name('books.index');

Route::get('/livros/{id}',[BookController::class, 'show'])
->name('books.show');
//fim das rotas de implementação




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
