<?php

use Spatie\Browsershot\Browsershot;
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

Route::get('/register', function () {

    // $pdf = PDF::loadView('certificate');
    // $pdf->setPaper(array(0, 0, 1000, 800), 'landscape');
    // $pdf->setOption('pdfBackend', 'GD');
    // $pdf->render();
    // return ($pdf->download('attestation.png'));
});
