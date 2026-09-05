<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\TipoPatrimonioController;
use App\Http\Controllers\PatrimonioController;
use App\Http\Controllers\TransferenciaPatrimonialController;
use App\Http\Controllers\FotografiaPatrimonioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuditoriaController;
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
        /*
|--------------------------------------------------------------------------
| Utilizadores
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Utilizadores
|--------------------------------------------------------------------------
*/

Route::get('/utilizadores', [UserController::class, 'index'])
    ->middleware('permission:utilizadores.visualizar')
    ->name('utilizadores.index');

Route::get('/utilizadores/create', [UserController::class, 'create'])
    ->middleware('permission:utilizadores.criar')
    ->name('utilizadores.create');

Route::post('/utilizadores', [UserController::class, 'store'])
    ->middleware('permission:utilizadores.criar')
    ->name('utilizadores.store');

Route::get('/utilizadores/{utilizador}', [UserController::class, 'show'])
    ->middleware('permission:utilizadores.visualizar')
    ->name('utilizadores.show');

Route::get('/utilizadores/{utilizador}/edit', [UserController::class, 'edit'])
    ->middleware('permission:utilizadores.editar')
    ->name('utilizadores.edit');

Route::put('/utilizadores/{utilizador}', [UserController::class, 'update'])
    ->middleware('permission:utilizadores.editar')
    ->name('utilizadores.update');

Route::patch('/utilizadores/{utilizador}', [UserController::class, 'update'])
    ->middleware('permission:utilizadores.editar')
    ->name('utilizadores.update.patch');

Route::delete('/utilizadores/{utilizador}', [UserController::class, 'destroy'])
    ->middleware('permission:utilizadores.eliminar')
    ->name('utilizadores.destroy');
});
/*
|--------------------------------------------------------------------------
| Módulos do SNRP
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


/*
|--------------------------------------------------------------------------
| Perfis de Acesso
|--------------------------------------------------------------------------
*/

Route::get('/perfis', [RoleController::class, 'index'])
    ->middleware('permission:perfis.visualizar')
    ->name('perfis.index');

Route::get('/perfis/create', [RoleController::class, 'create'])
    ->middleware('permission:perfis.criar')
    ->name('perfis.create');

Route::post('/perfis', [RoleController::class, 'store'])
    ->middleware('permission:perfis.criar')
    ->name('perfis.store');

Route::get('/perfis/{role}', [RoleController::class, 'show'])
    ->middleware('permission:perfis.visualizar')
    ->name('perfis.show');

Route::get('/perfis/{role}/edit', [RoleController::class, 'edit'])
    ->middleware('permission:perfis.editar')
    ->name('perfis.edit');

Route::put('/perfis/{role}', [RoleController::class, 'update'])
    ->middleware('permission:perfis.editar')
    ->name('perfis.update');

Route::patch('/perfis/{role}', [RoleController::class, 'update'])
    ->middleware('permission:perfis.editar')
    ->name('perfis.update.patch');

Route::delete('/perfis/{role}', [RoleController::class, 'destroy'])
    ->middleware('permission:perfis.eliminar')
    ->name('perfis.destroy');
    /*
|--------------------------------------------------------------------------
| Auditoria
|--------------------------------------------------------------------------
*/

Route::get('/auditorias', [AuditoriaController::class, 'index'])
    ->middleware('permission:auditoria.visualizar')
    ->name('auditorias.index');

Route::get('/auditorias/{auditoria}', [AuditoriaController::class, 'show'])
    ->middleware('permission:auditoria.visualizar')
    ->name('auditorias.show');
    /*
    |--------------------------------------------------------------------------
    | Instituições
    |--------------------------------------------------------------------------
    */

    Route::resource(
    'instituicoes',
    InstituicaoController::class
)->parameters([
    'instituicoes' => 'instituicao',
]);


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