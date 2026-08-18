<?php

namespace App\Http\Controllers;

use App\Models\Instituicao;
use Illuminate\Http\Request;

class InstituicaoController extends Controller
{
    /**
     * Lista todas as instituições.
     */
    public function index()
    {
        $instituicoes = Instituicao::orderBy('nome')->paginate(10);

        return view('instituicoes.index', compact('instituicoes'));
    }

    /**
     * Formulário para cadastrar uma instituição.
     */
    public function create()
    {
        return view('instituicoes.create');
    }

    /**
     * Guarda uma nova instituição.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'sigla' => 'required|string|max:50',
            'nif' => 'nullable|string|max:30',
            'telefone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'endereco' => 'nullable|string',
            'logo' => 'nullable|string|max:255',
            'ativo' => 'nullable|boolean',
        ]);

        $validated['ativo'] = $request->boolean('ativo');

        Instituicao::create($validated);

        return redirect()
            ->route('instituicoes.index')
            ->with('success', 'Instituição cadastrada com sucesso.');
    }

    /**
     * Mostra os dados de uma instituição.
     */
    public function show(Instituicao $instituicao)
    {
        return view('instituicoes.show', compact('instituicao'));
    }

    /**
     * Formulário de edição.
     */
    public function edit(Instituicao $instituicao)
    {
        return view('instituicoes.edit', compact('instituicao'));
    }

    /**
     * Atualiza uma instituição.
     */
    public function update(Request $request, Instituicao $instituicao)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'sigla' => 'required|string|max:50',
            'nif' => 'nullable|string|max:30',
            'telefone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'endereco' => 'nullable|string',
            'logo' => 'nullable|string|max:255',
            'ativo' => 'nullable|boolean',
        ]);

        $validated['ativo'] = $request->boolean('ativo');

        $instituicao->update($validated);

        return redirect()
            ->route('instituicoes.index')
            ->with('success', 'Instituição atualizada com sucesso.');
    }

    /**
     * Remove uma instituição.
     */
    public function destroy(Instituicao $instituicao)
    {
        // Não permite apagar instituições que possuem utilizadores.
        if ($instituicao->users()->exists()) {
            return redirect()
                ->route('instituicoes.index')
                ->with('error', 'Esta instituição possui utilizadores associados e não pode ser eliminada.');
        }

        $instituicao->delete();

        return redirect()
            ->route('instituicoes.index')
            ->with('success', 'Instituição eliminada com sucesso.');
    }
}