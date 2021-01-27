<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::view('/tes', 'top-anime');
Route::get('/main-dashboard', [AdminController::class, 'indexDashboard']);
Route::get('/poll/top-anime', [AdminController::class, 'indexTopAnime']);
Route::post('/poll/top-anime/store', [AdminController::class, 'storeAnime']);








Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';