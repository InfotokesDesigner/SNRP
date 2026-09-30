<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use App\Models\Pessoa;
use App\Models\Patrimonio;
use App\Models\User;
use App\Models\TransferenciaPatrimonial;
use App\Models\TipoPatrimonio;

class DashboardController extends Controller
{
    public function index()
    {
        $totalInstituicoes = Instituicao::count();
        $totalPessoas = Pessoa::count();
        $totalPatrimonios = Patrimonio::count();
        $totalUtilizadores = User::count();
        $totalTransferencias = TransferenciaPatrimonial::count();

        /*
        |--------------------------------------------------------------------------
        | Patrimónios por tipo
        |--------------------------------------------------------------------------
        */

        $patrimoniosPorTipo = TipoPatrimonio::withCount('patrimonios')
            ->get()
            ->map(function ($tipo) {
                return [
                    'tipo' => $tipo->nome,
                    'total' => $tipo->patrimonios_count,
                ];
            });



 $registosPatrimonios = Patrimonio::selectRaw('YEAR(created_at) as ano, MONTH(created_at) as mes, COUNT(*) as total')

->groupByRaw('YEAR(created_at), MONTH(created_at)')

->orderByRaw('YEAR(created_at), MONTH(created_at)')

->get();

$labelsRegistos = $registosPatrimonios->map(function ($item) {

return \Carbon\Carbon::createFromDate($item->ano, $item->mes, 1)->translatedFormat('M/Y');

})->values();

$dadosRegistos = $registosPatrimonios->pluck('total')->values();
$transferenciasPorMes = TransferenciaPatrimonial::selectRaw(
        'YEAR(data_transferencia) as ano,
        MONTH(data_transferencia) as mes,
        COUNT(*) as total'
    )
    ->groupByRaw('YEAR(data_transferencia), MONTH(data_transferencia)')
    ->orderByRaw('YEAR(data_transferencia), MONTH(data_transferencia)')
    ->get();

$labelsTransferencias = $transferenciasPorMes->map(function ($item) {
    return \Carbon\Carbon::createFromDate($item->ano, $item->mes, 1)
        ->translatedFormat('M/Y');
})->values();

$dadosTransferencias = $transferenciasPorMes
    ->pluck('total')
    ->values();


              
 $patrimoniosEsteMes = Patrimonio::whereMonth('created_at', now()->month)

->whereYear('created_at', now()->year)

->count();

        return view('dashboard', compact(
    'totalInstituicoes',
    'totalPessoas',
    'totalPatrimonios',
    'totalUtilizadores',
    'totalTransferencias',
    'patrimoniosPorTipo',
    'labelsRegistos',
    'dadosRegistos',
    'labelsTransferencias',
    'dadosTransferencias',
    'patrimoniosEsteMes',
));

      
    }
}