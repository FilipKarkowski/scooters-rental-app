<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\PlacowkiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KierownicyController;
use App\Http\Controllers\KlienciController;
use App\Http\Controllers\PracownicyController;
use App\Http\Controllers\RezerwacjeController;
use App\Http\Controllers\RaportyController;


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
    if(\Illuminate\Support\Facades\Auth::check())
    {
        return redirect('/placowki');
    }
    else
        return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');

})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/rezerwacje', [RezerwacjeController::class, 'index'])->name('rezerwacje.index');
Route::post('/rezerwacje', [RezerwacjeController::class, 'store'])->name('rezerwacje.store');
Route::put('/rezerwacje/{rezerwacja}', [RezerwacjeController::class, 'update'])->name('rezerwacje.update');
Route::delete('/rezerwacje/{rezerwacja}', [RezerwacjeController::class, 'destroy'])->name('rezerwacje.destroy');

Route::get('/placowki', [PlacowkiController::class, 'index'])->name('placowki.index');

Route::get('/hulajnogi', [\App\Http\Controllers\HulajnogiController::class, 'index'])->name('hulajnogi.index');

Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::post('/placowki', [PlacowkiController::class, 'store'])->name('placowki.store');
    Route::put('/placowki/{placowka}', [PlacowkiController::class, 'update'])->name('placowki.update');
    Route::delete('/placowki/{placowka}', [PlacowkiController::class, 'destroy'])->name('placowki.destroy');

    // Route::get('/users', [UserController::class, 'index'])->name('users.index');
    // Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    // Route::post('/users', [UserController::class, 'store'])->name('users.store');
    // Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    // Route::put('/users/{id}', [UserController::class,'update'])->name('users.update');

    Route::post('/kliencikonta', [UserController::class, 'storeklient'])->name('users.storeklient');

    Route::put('/employees/{employee}',[PracownicyController::class,'update'])->name('employees.update');
    Route::put('/employees/{employee}',[PracownicyController::class,'update'])->name('employees.update');

    Route::put('/admins/{admin}', [UserController::class,'update'])->name('admins.update');
    Route::put('/clients/{id}', [UserController::class,'update'])->name('clients.update');

    Route::get('/kierownicy', [KierownicyController::class, 'index'])->name('kierownicy.index');
    Route::get('/kierownicy/create', [KierownicyController::class, 'create'])->name('kierownicy.create');
    Route::post('/kierownicy', [KierownicyController::class, 'store'])->name('kierownicy.store');
    Route::get('/kierownicy/{kierownicy}/edit', [KierownicyController::class, 'edit'])->name('kierownicy.edit');
    Route::put('/kierownicy/{id}', [KierownicyController::class,'update'])->name('kierownicy.update');
    Route::delete('/kierownicy/{kierownicy}', [KierownicyController::class, 'destroy'])->name('kierownicy.destroy');

    Route::get('/klienci', [\App\Http\Controllers\KlienciController::class, 'index'])->name('klienci.index');
    Route::post('/klienci',[\App\Http\Controllers\KlienciController::class, 'store'])->name('klienci.store');
    Route::delete('/klienci/{id}', [\App\Http\Controllers\KlienciController::class, 'destroy'])->name('klienci.destroy');
    Route::put('/klienci/{klient}', [\App\Http\Controllers\KlienciController::class, 'update'])->name('klienci.update');
    Route::get('/kliencikonta', [UserController::class,'index'])->name('kliencikonta.index');
    Route::get('/pracownicy', [PracownicyController::class, 'index'])->name('pracownicy.index');
    Route::get('/pracownicy/create', [PracownicyController::class, 'create'])->name('pracownicy.create');
    Route::post('/pracownicy', [PracownicyController::class, 'store'])->name('pracownicy.store');

    Route::get('/pracownicy/{pracownicy}/edit', [PracownicyController::class, 'edit'])->name('pracownicy.edit');
    //Route::delete('/pracownicy/{pracownicy}', [PracownicyController::class, 'destroy'])->name('pracownicy.destroy');
    Route::put('/pracownicy/{id}/changerole', [PracownicyController::class, 'changeRole'])->name('pracownicy.changerole');
    Route::put('/pracownicy/{id}', [PracownicyController::class,'update'])->name('pracownicy.update');

    Route::post('/pracownicy', [UserController::class, 'store'])->name('users.store');
    Route::delete('/pracownicy/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/pracownicy/create', [PracownicyController::class, 'create'])->name('pracownicy.create');
    Route::put('/pracownicy/{id}/changerole', [PracownicyController::class, 'changeRole'])->name('pracownicy.changerole');

    //Route::get('/hulajnogi', [\App\Http\Controllers\HulajnogiController::class, 'index'])->name('hulajnogi.index');
	Route::post('/hulajnogi',[\App\Http\Controllers\HulajnogiController::class, 'store'])->name('hulajnogi.store');
	Route::delete('/hulajnogi/{id}', [\App\Http\Controllers\HulajnogiController::class, 'destroy'])->name('hulajnogi.destroy');
	Route::put('/hulajnogi/{hulajnoga}', [\App\Http\Controllers\HulajnogiController::class, 'update'])->name('hulajnogi.update');

    Route::get('/raporty', [RaportyController::class, 'index'])->name('raporty.index');
    Route::post('/raporty', [RaportyController::class, 'store'])->name('raporty.store');
    Route::get('/raporty/{id}/edit', [RaportyController::class, 'edit'])->name('raporty.edit');
    Route::put('/raporty/{id}', [RaportyController::class, 'update'])->name('raporty.update');
    Route::delete('/raporty/{id}', [RaportyController::class, 'destroy'])->name('raporty.destroy');

    Route::get('/rewizje', [\App\Http\Controllers\RewizjeController::class, 'index'])->name('rewizje.index');
    Route::post('/rewizje', [\App\Http\Controllers\RewizjeController::class, 'store'])->name('rewizje.store');
    Route::put('/rewizje/{rewizja}', [\App\Http\Controllers\RewizjeController::class, 'update'])->name('rewizje.update');
    Route::delete('/rewizje/{rewizja}', [\App\Http\Controllers\RewizjeController::class, 'destroy'])->name('rewizje.destroy');

    Route::get('/wypozyczenia', [\App\Http\Controllers\WypozyczeniaController::class, 'index'])->name('wypozyczenia.index');
    Route::post('/wypozyczenia', [\App\Http\Controllers\WypozyczeniaController::class, 'store'])->name('wypozyczenia.store');
    Route::put('/wypozyczenia/{wypozyczenia}', [\App\Http\Controllers\WypozyczeniaController::class, 'update'])->name('wypozyczenia.update');
    Route::delete('/wypozyczenia/{wypozyczenia}', [\App\Http\Controllers\WypozyczeniaController::class, 'destroy'])->name('wypozyczenia.destroy');

    Route::get('/odbiory', [\App\Http\Controllers\OdbioryController::class, 'index'])->name('odbiory.index');
    Route::post('/odbiory', [\App\Http\Controllers\OdbioryController::class, 'store'])->name('odbiory.store');
    Route::delete('/odbiory/{odbior}', [\App\Http\Controllers\OdbioryController::class, 'destroy'])->name('odbiory.destroy');

    Route::get('/podsumowania', [\App\Http\Controllers\PodsumowaniaController::class, 'index'])->name('podsumowania.index');
    Route::post('/podsumowania', [\App\Http\Controllers\PodsumowaniaController::class, 'store'])->name('podsumowania.store');
    Route::delete('/podsumowania/{podsumowanie}', [\App\Http\Controllers\PodsumowaniaController::class, 'destroy'])->name('podsumowania.destroy');
});
