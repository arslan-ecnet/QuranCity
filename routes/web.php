<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourcesController;
use App\Http\Controllers\SuburbController;
use App\Http\Controllers\SuraController;
use App\Http\Controllers\SuraDetailController;
use App\Http\Controllers\ThemeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('profile',[ProfileController::class,'index'])->name('profile');
    Route::get('themes',[ThemeController::class,'index'])->name('themeList');
    Route::get('themes/create',[ThemeController::class,'create'])->name('createTheme');
    Route::post('themes/create',[ThemeController::class,'save'])->name('createTheme');
    Route::get('themes/edit/{id}',[ThemeController::class,'edit'])->name('editTheme');
    Route::post('themes/edit/{id}',[ThemeController::class,'update'])->name('updateTheme');
    Route::get('themes/delete/{id}',[ThemeController::class,'delete'])->name('deleteTheme');

    Route::prefix('sura')->name('surah')->group(function () {
        Route::get('/',[SuraController::class,'index'])->name('List');
        Route::get('/create',[SuraController::class,'create'])->name('Create');
        Route::post('/create',[SuraController::class,'save'])->name('Create');
        Route::get('/edit/{id}',[SuraController::class,'edit'])->name('Edit');
        Route::post('/edit/{id}',[SuraController::class,'update'])->name('Update');
        Route::get('/delete/{id}',[SuraController::class,'delete'])->name('Delete');
    });
    Route::prefix('details')->name('surahDetail')->group(function () {
       Route::get('/',[SuraDetailController::class,'index'])->name('List');
       Route::get('/create',[SuraDetailController::class,'create'])->name('Create');
       Route::post('/create',[SuraDetailController::class,'save'])->name('Create');
       Route::get('/edit/{id}',[SuraDetailController::class,'edit'])->name('Edit');
       Route::post('/edit/{id}',[SuraDetailController::class,'update'])->name('Update');
       Route::get('/delete/{id}',[SuraDetailController::class,'delete'])->name('Delete');
    });

});

Auth::routes();
Route::get('/test' , function (){
   return view('dashboard');
});
