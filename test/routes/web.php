<?php

use App\Http\Controllers\CSVReader;
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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('csvreader');
// });

Route::get('/', [CSVReader::class, 'showUploadForm']);
Route::post('/parse', [CSVReader::class, 'parseCsv'])->name('parse.csv');