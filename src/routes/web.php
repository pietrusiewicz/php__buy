<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/okregowa', [PageController::class, 'okregowa'])->name('okregowa');
Route::get('/aklasa', [PageController::class, 'aklasa'])->name('aklasa');
Route::get('/bklasa', [PageController::class, 'bklasa'])->name('bklasa');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/cards', [PageController::class, 'cards'])->name('cards');
Route::post('/submit-card', [PageController::class, 'submitCard'])->name('submit-card');

//Route::post('/submit-number', [NumberController::class, 'submitNumber'])->name('submit.number');