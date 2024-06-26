<?php
use App\Http\Controllers\BinomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::get('/dashboard', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');;
Route::get('/importation', [PostController::class, 'importation'])->name('importer_fichiers');
Route::get('/constitution', [PostController::class, 'constitution'])->name('constituer_jury');
Route::get('/generation', [PostController::class, 'generation'])->name('generer_planning');
Route::post('/dashboard', [PostController::class, 'filter'])->middleware(['auth', 'verified'])->name('filter');;




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('import', [BinomeController::class, 'importExcel'])->name('import.excel');

use App\Http\Controllers\juryController;
Route::post('maker-jury', [juryController::class, 'constituerJurys'])->name('maker.jury');
Route::put('/planifications/{id}', [juryController::class, 'update'])->name('planifications.update');
Route::delete('/planifications/{id}', [juryController::class, 'destroy'])->name('planifications.destroy');


require __DIR__.'/auth.php';
