<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Http\Controllers\NightClubController;


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
    return view('welcome');
});
Route::get('/club', [NightClubController::class, 'clubWorks']);
Route::get('/club-start', [NightClubController::class, 'clubStartWorking']);