<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuraController;
use App\Http\Controllers\SuraDetailController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\VerseController;
use App\Http\Controllers\VerseDetailController;
use App\Http\Controllers\AudioFileController;
use App\Http\Controllers\ReciterController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\VerseTranslationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profileUpdate');
    Route::get('themes', [ThemeController::class, 'index'])->name('themeList');
    Route::get('themes/create', [ThemeController::class, 'create'])->name('createTheme');
    Route::post('themes/create', [ThemeController::class, 'save'])->name('createTheme');
    Route::get('themes/edit/{id}', [ThemeController::class, 'edit'])->name('editTheme');
    Route::post('themes/edit/{id}', [ThemeController::class, 'update'])->name('updateTheme');
    Route::get('themes/delete/{id}', [ThemeController::class, 'delete'])->name('deleteTheme');

    Route::prefix('surah')->name('surah')->group(function () {
        Route::get('/', [SuraController::class, 'index'])->name('List');
        Route::get('/create', [SuraController::class, 'create'])->name('Create');
        Route::post('/create', [SuraController::class, 'save'])->name('Create');
        Route::get('/edit/{id}', [SuraController::class, 'edit'])->name('Edit');
        Route::post('/edit/{id}', [SuraController::class, 'update'])->name('Update');
        Route::get('/delete/{id}', [SuraController::class, 'delete'])->name('Delete');
    });
    Route::prefix('surah/details')->name('surahDetail')->group(function () {
        Route::get('/', [SuraDetailController::class, 'index'])->name('List');
        Route::get('/create', [SuraDetailController::class, 'create'])->name('Create');
        Route::post('/create', [SuraDetailController::class, 'save'])->name('Create');
        Route::get('/edit/{id}', [SuraDetailController::class, 'edit'])->name('Edit');
        Route::post('/edit/{id}', [SuraDetailController::class, 'update'])->name('Update');
        Route::get('/delete/{id}', [SuraDetailController::class, 'delete'])->name('Delete');
    });
    Route::prefix('verse')->name('verse')->group(function () {
        Route::get('/', [VerseController::class, 'index'])->name('List');
        Route::get('/create', [VerseController::class, 'create'])->name('Create');
        Route::post('/create', [VerseController::class, 'save'])->name('Create');
        Route::get('/edit/{id}', [VerseController::class, 'edit'])->name('Edit');
        Route::post('/edit/{id}', [VerseController::class, 'update'])->name('Update');
        Route::get('/delete/{id}', [VerseController::class, 'delete'])->name('Delete');
    });
    Route::prefix('verse-details')->name('verseDetail')->group(function () {
        Route::get('/', [VerseDetailController::class, 'index'])->name('List');
        Route::get('/create', [VerseDetailController::class, 'create'])->name('Create');
        Route::post('/create', [VerseDetailController::class, 'save'])->name('Create');
        Route::get('/edit/{id}', [VerseDetailController::class, 'edit'])->name('Edit');
        Route::post('/edit/{id}', [VerseDetailController::class, 'update'])->name('Update');
        Route::get('/delete/{id}', [VerseDetailController::class, 'delete'])->name('Delete');
    });
    
    Route::prefix('reciter')->name('reciter')->group(function () {
        Route::get('/', [ReciterController::class, 'index'])->name('List');
        Route::get('/create', [ReciterController::class, 'create'])->name('Create');
        Route::post('/create', [ReciterController::class, 'save'])->name('Create');
        Route::get('/edit/{id}', [ReciterController::class, 'edit'])->name('Edit');
        Route::post('/edit/{id}', [ReciterController::class, 'update'])->name('Update');
        Route::get('/delete/{id}', [ReciterController::class, 'delete'])->name('Delete');
    });
    Route::prefix('translation')->name('translation')->group(function () {
        Route::get('/', [TranslationController::class, 'index'])->name('List');
        Route::get('/create', [TranslationController::class, 'create'])->name('Create');
        Route::post('/create', [TranslationController::class, 'save'])->name('Create');
        Route::get('/edit/{id}', [TranslationController::class, 'edit'])->name('Edit');
        Route::post('/edit/{id}', [TranslationController::class, 'update'])->name('Update');
        Route::get('/delete/{id}', [TranslationController::class, 'delete'])->name('Delete');
    });
    Route::prefix('audio-file')->name('audioFile')->group(function () {
        Route::get('/', [AudioFileController::class, 'index'])->name('List');
        Route::get('/create', [AudioFileController::class, 'create'])->name('Create');
        Route::post('/create', [AudioFileController::class, 'save'])->name('Create');
        Route::get('/edit/{id}', [AudioFileController::class, 'edit'])->name('Edit');
        Route::post('/edit/{id}', [AudioFileController::class, 'update'])->name('Update');
        Route::get('/delete/{id}', [AudioFileController::class, 'delete'])->name('Delete');
    });
    Route::prefix('verse-translation')->name('verseTranslation')->group(function () {
        Route::get('/', [VerseTranslationController::class, 'index'])->name('List');
        Route::get('/create', [VerseTranslationController::class, 'create'])->name('Create');
        Route::post('/create', [VerseTranslationController::class, 'save'])->name('Create');
        Route::get('/edit/{id}', [VerseTranslationController::class, 'edit'])->name('Edit');
        Route::post('/edit/{id}', [VerseTranslationController::class, 'update'])->name('Update');
        Route::get('/delete/{id}', [VerseTranslationController::class, 'delete'])->name('Delete');
    });

});

Auth::routes();
Route::get('/test', function () {
    return view('dashboard');
});
