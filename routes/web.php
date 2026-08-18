<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\TipoPatrimonioController;
use App\Http\Controllers\PatrimonioController;

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Página inicial
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})
->middleware(['auth', 'verified'])
->name('dashboard');


/*
|--------------------------------------------------------------------------
| Perfil do utilizador
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| Módulos do SNRP
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Instituições
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'instituicoes',
        InstituicaoController::class
    );


    /*
    |--------------------------------------------------------------------------
    | Pessoas
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'pessoas',
        PessoaController::class
    );


    /*
    |--------------------------------------------------------------------------
    | Tipos de Património
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'tipos-patrimonio',
        TipoPatrimonioController::class
    )->parameters([
        'tipos-patrimonio' => 'tipoPatrimonio'
    ]);


    /*
    |--------------------------------------------------------------------------
    | Patrimónios
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'patrimonios',
        PatrimonioController::class
    );

});


/*
|--------------------------------------------------------------------------
| Autenticação
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';