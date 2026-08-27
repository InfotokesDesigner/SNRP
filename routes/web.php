<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\TipoPatrimonioController;
use App\Http\Controllers\PatrimonioController;
use App\Http\Controllers\TransferenciaPatrimonialController;
use App\Http\Controllers\FotografiaPatrimonioController;
use App\Http\Controllers\DashboardController;

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Página inicial
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/



Route::get('/dashboard', [DashboardController::class, 'index'])
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

    /*
|--------------------------------------------------------------------------
| Transferências Patrimoniais
|--------------------------------------------------------------------------
*/

Route::resource(
    'transferencias-patrimoniais',
    TransferenciaPatrimonialController::class
)->parameters([
    'transferencias-patrimoniais' => 'transferencia'
])->only([
    'index',
    'create',
    'store',
    'show'
]);
/*
|--------------------------------------------------------------------------
| Fotografias dos Patrimónios
|--------------------------------------------------------------------------
*/

Route::post(
    '/patrimonios/{patrimonio}/fotografias',
    [FotografiaPatrimonioController::class, 'store']
)->name('patrimonios.fotografias.store');

Route::delete(
    '/patrimonios/{patrimonio}/fotografias/{fotografia}',
    [FotografiaPatrimonioController::class, 'destroy']
)->name('patrimonios.fotografias.destroy');

Route::patch(
    'patrimonios/{patrimonio}/fotografias/{fotografia}/principal',
    [FotografiaPatrimonioController::class, 'principal']
)->name('patrimonios.fotografias.principal');

});
/*
|--------------------------------------------------------------------------
| Consulta pública de património
|--------------------------------------------------------------------------
*/

Route::get(
    '/consulta-patrimonio/{codigo}',
    [PatrimonioController::class, 'consultaPublica']
)->name('patrimonios.consulta');




/*
|--------------------------------------------------------------------------
| Página inicial da Consulta Pública
|--------------------------------------------------------------------------
*/

Route::get('/consulta-publica', function () {
    return view('consulta-publica');
})->name('consulta.publica');



/*
|--------------------------------------------------------------------------
| Autenticação
|--------------------------------------------------------------------------
*/



require __DIR__.'/auth.php';