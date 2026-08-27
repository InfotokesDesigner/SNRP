<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use App\Models\Pessoa;
use App\Models\Patrimonio;
use App\Models\User;
use App\Models\TransferenciaPatrimonial;

class DashboardController extends Controller
{
    /**
     * Exibe o Dashboard principal do SNRP.
     */
    public function index()
    {
        $totalInstituicoes = Instituicao::count();

        $totalPessoas = Pessoa::count();

        $totalPatrimonios = Patrimonio::count();

        $totalUtilizadores = User::count();

        $totalTransferencias = TransferenciaPatrimonial::count();

        return view('dashboard', compact(
            'totalInstituicoes',
            'totalPessoas',
            'totalPatrimonios',
            'totalUtilizadores',
            'totalTransferencias'
        ));
    }
}