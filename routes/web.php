<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/list');
    }
})->middleware(['auth', 'verified'])->name('main');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/list', [App\Http\Controllers\ItemController::class, 'index'])->name('list');
    Route::get('/list/import', [App\Http\Controllers\ItemController::class, 'import'])->name('list.import');
    Route::post('/list/import', [App\Http\Controllers\ItemController::class, 'storeImport'])->name('list.import.store');
    Route::get('/list/export', [App\Http\Controllers\ItemController::class, 'export'])->name('list.export');
    Route::post('item/{id}/mark-as-bought/', [App\Http\Controllers\ItemController::class, 'markAsBought'])->name('markAsBought');
});

Route::resource('item', App\Http\Controllers\ItemController::class)->middleware(['auth']);

require __DIR__ . '/auth.php';
