<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use \Inertia\Inertia;

// Route::get('/',[WorkController::class,"home"])->name('portfolio.homeSweetHome');

Route::get("/",function(){
    return Inertia::render('HomePage');
})->name("homeSweetHome");

// Route::get("/livros",function(){
//     return Inertia::render('BooksPage');
// })->name("books");

// Route::get("/alugueis",function(){
//     return Inertia::render('RentalsPage');
// })->name("rentals");

// Route::get('rel',function(){
//     $teste = Rent::query()->with(['user','book'])->get();
//     echo '<pre>';
//     echo json_encode($teste,JSON_PRETTY_PRINT);
//     echo '</pre>';
// });


Route::resource('users',UserController::class);
Route::resource('books',BookController::class);
Route::resource('rents',RentController::class);

Route::post('relatorio',[ReportController::class,'rents'])->name('report');