<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // cria lógica para avaliar rota a ser chamada
    if(Auth::user()->role_id == 2){
        return view('catador');
    }else {
        return view('reciclador');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Nova rota para o redirecionamento do dashboard do catador
Route::get('/catador', function () {
    return view('catador');
})->middleware(['auth', 'verified'])->name('catador');

// Nova rota para o redirecionamento do dashboard do reciclador
Route::get('/reciclador', function () {
    return view('reciclador');
})->middleware(['auth', 'verified'])->name('reciclador');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
