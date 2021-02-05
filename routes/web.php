<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApiController;
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

Route::get('/main-dashboard', [AdminController::class, 'indexDashboard']);
Route::get('/poll/top-anime', [AdminController::class, 'indexTopAnime']);
Route::post('/poll/top-anime/store', [AdminController::class, 'storeAnime']);
Route::post('/poll/top-anime/adjust', [AdminController::class, 'adjustAnime']);
Route::get('/poll/top-anime/get-year/{seasonid}', [AdminController::class, 'getYear']);
Route::post('/poll/top-anime/store-poster', [AdminController::class, 'storePoster']);


// consume api
Route::get('/api/get-anime', [ApiController::class, 'getAnime']);
Route::post('/api/submit-vote', [ApiController::class, 'submitVote']);









Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';