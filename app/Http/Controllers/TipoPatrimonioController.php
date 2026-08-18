<?php

namespace App\Http\Controllers;

use App\Models\TipoPatrimonio;
use Illuminate\Http\Request;

class TipoPatrimonioController extends Controller
{
    /**
     * Lista os tipos de património.
     */
    public function index(Request $request)
    {
        $pesquisa = $request->input('pesquisa');

        $tipos = TipoPatrimonio::query()
            ->when($pesquisa, function ($query, $pesquisa) {
                $query->where(function ($q) use ($pesquisa) {
                    $q->where('nome', 'like', "%{$pesquisa}%")
                        ->orWhere('descricao', 'like', "%{$pesquisa}%");
                });
            })
            ->orderBy('nome')
            ->paginate(10)
            ->withQueryString();

        return view('tipos-patrimonio.index', compact('tipos'));
    }

    /**
     * Formulário de novo tipo.
     */
    public function create()
    {
        return view('tipos-patrimonio.create');
    }

    /**
     * Guarda um novo tipo.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:100|unique:tipo_patrimonios,nome',
            'descricao' => 'nullable|string',
            'ativo' => 'nullable|boolean',
        ]);

        $validated['ativo'] = $request->boolean('ativo');

        TipoPatrimonio::create($validated);

        return redirect()
            ->route('tipos-patrimonio.index')
            ->with('success', 'Tipo de património cadastrado com sucesso.');
    }

    /**
     * Mostra um tipo.
     */
    public function show(TipoPatrimonio $tipoPatrimonio)
    {
        $tipoPatrimonio->load('patrimonios');

        return view(
            'tipos-patrimonio.show',
            compact('tipoPatrimonio')
        );
    }

    /**
     * Formulário de edição.
     */
    public function edit(TipoPatrimonio $tipoPatrimonio)
    {
        return view(
            'tipos-patrimonio.edit',
            compact('tipoPatrimonio')
        );
    }

    /**
     * Atualiza um tipo.
     */
    public function update(
        Request $request,
        TipoPatrimonio $tipoPatrimonio
    ) {
        $validated = $request->validate([
            'nome' => 'required|string|max:100|unique:tipo_patrimonios,nome,' . $tipoPatrimonio->id,
            'descricao' => 'nullable|string',
            'ativo' => 'nullable|boolean',
        ]);

        $validated['ativo'] = $request->boolean('ativo');

        $tipoPatrimonio->update($validated);

        return redirect()
            ->route('tipos-patrimonio.index')
            ->with('success', 'Tipo de património atualizado com sucesso.');
    }

    /**
     * Elimina um tipo.
     */
    public function destroy(TipoPatrimonio $tipoPatrimonio)
    {
        if ($tipoPatrimonio->patrimonios()->exists()) {
            return redirect()
                ->route('tipos-patrimonio.index')
                ->with(
                    'error',
                    'Este tipo possui patrimónios associados e não pode ser eliminado.'
                );
        }

        $tipoPatrimonio->delete();

        return redirect()
            ->route('tipos-patrimonio.index')
            ->with(
                'success',
                'Tipo de património eliminado com sucesso.'
            );
    }
}