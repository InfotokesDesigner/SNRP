<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use App\Models\User;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    /**
     * Lista o histórico de auditorias.
     */
    public function index(Request $request)
    {
        $query = Auditoria::with('user')
            ->latest('created_at');

        /*
         * Pesquisa geral
         */
        if ($request->filled('pesquisa')) {
            $pesquisa = $request->pesquisa;

            $query->where(function ($q) use ($pesquisa) {
                $q->where('descricao', 'like', "%{$pesquisa}%")
                    ->orWhere('acao', 'like', "%{$pesquisa}%")
                    ->orWhere('modulo', 'like', "%{$pesquisa}%")
                    ->orWhereHas('user', function ($userQuery) use ($pesquisa) {
                        $userQuery
                            ->where('name', 'like', "%{$pesquisa}%")
                            ->orWhere('email', 'like', "%{$pesquisa}%");
                    });
            });
        }

        /*
         * Filtro por ação
         */
        if ($request->filled('acao')) {
            $query->where('acao', $request->acao);
        }

        /*
         * Filtro por módulo
         */
        if ($request->filled('modulo')) {
            $query->where('modulo', $request->modulo);
        }

        /*
         * Filtro por utilizador
         */
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $auditorias = $query
            ->paginate(15)
            ->withQueryString();

        $utilizadores = User::orderBy('name')->get([
            'id',
            'name',
        ]);

        $acoes = Auditoria::query()
            ->select('acao')
            ->distinct()
            ->orderBy('acao')
            ->pluck('acao');

        $modulos = Auditoria::query()
            ->select('modulo')
            ->whereNotNull('modulo')
            ->distinct()
            ->orderBy('modulo')
            ->pluck('modulo');

        return view(
            'auditorias.index',
            compact(
                'auditorias',
                'utilizadores',
                'acoes',
                'modulos'
            )
        );
    }

    /**
     * Mostra os detalhes de uma auditoria.
     */
    public function show(Auditoria $auditoria)
    {
        $auditoria->load('user');

        return view(
            'auditorias.show',
            compact('auditoria')
        );
    }
}