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

Route::prefix('berita')->group(function () {
   Route::get('/', [AdminController::class, 'indexBerita']);
   Route::post('/store', [AdminController::class, 'storeBerita']);
});

Route::prefix('poll')->group(function () {
   Route::get('top-anime', [AdminController::class, 'indexTopAnime']);
   Route::post('top-anime/store', [AdminController::class, 'storeAnime']);
   Route::post('top-anime/adjust', [AdminController::class, 'adjustAnime']);
   Route::get('top-anime/get-year/{seasonid}', [AdminController::class, 'getYear']);
   Route::post('top-anime/store-poster', [AdminController::class, 'storePoster']);
   Route::get('top-anime/get-statistic', [AdminController::class, 'getStatistic']);
   Route::post('top-anime/delete-anime', [AdminController::class, 'deleteAnime']);
});



// consume api
Route::get('/api/get-anime', [ApiController::class, 'getAnime']);
Route::get('/api/get-berita/{beritaid}', [ApiController::class, 'getSpesificBerita']);
Route::get('/api/getall-berita', [ApiController::class, 'getBerita']);
Route::post('/api/submit-vote', [ApiController::class, 'submitVote']);









Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';