<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PessoaController extends Controller
{
    /**
     * Lista todas as pessoas.
     */
    public function index(Request $request)
    {
        $query = Pessoa::query();

        // Pesquisa
        if ($request->filled('pesquisa')) {

            $pesquisa = $request->pesquisa;

            $query->where(function ($q) use ($pesquisa) {

                $q->where('nome_completo', 'like', "%{$pesquisa}%")
                    ->orWhere('bi', 'like', "%{$pesquisa}%")
                    ->orWhere('nif', 'like', "%{$pesquisa}%")
                    ->orWhere('telefone', 'like', "%{$pesquisa}%");
            });
        }

        $pessoas = $query
            ->orderBy('nome_completo')
            ->paginate(10)
            ->withQueryString();

        return view('pessoas.index', compact('pessoas'));
    }


    /**
     * Formulário para cadastrar pessoa.
     */
    public function create()
    {
        return view('pessoas.create');
    }


    /**
     * Guarda uma nova pessoa.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'nome_completo' => 'required|string|max:255',

            'bi' => 'nullable|string|max:30|unique:pessoas,bi',

            'nif' => 'nullable|string|max:30|unique:pessoas,nif',

            'data_nascimento' => 'nullable|date',

            'sexo' => 'nullable|in:Masculino,Feminino',

            'telefone' => 'nullable|string|max:30',

            'email' => 'nullable|email|max:255',

            'morada' => 'nullable|string',

            'fotografia' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'ativo' => 'nullable|boolean',

        ]);


        // Estado
        $validated['ativo'] = $request->boolean('ativo');


        // Upload da fotografia
        if ($request->hasFile('fotografia')) {

            $validated['fotografia'] =
                $request->file('fotografia')
                    ->store('pessoas', 'public');
        }


        Pessoa::create($validated);


        return redirect()
            ->route('pessoas.index')
            ->with('success', 'Pessoa cadastrada com sucesso.');
    }


    /**
     * Mostra os dados da pessoa.
     */
    public function show(Pessoa $pessoa)
    {
        $pessoa->load('patrimonios');

        return view('pessoas.show', compact('pessoa'));
    }


    /**
     * Formulário de edição.
     */
    public function edit(Pessoa $pessoa)
    {
        return view('pessoas.edit', compact('pessoa'));
    }


    /**
     * Atualiza uma pessoa.
     */
    public function update(Request $request, Pessoa $pessoa)
    {
        $validated = $request->validate([

            'nome_completo' => 'required|string|max:255',

            'bi' => 'nullable|string|max:30|unique:pessoas,bi,' . $pessoa->id,

            'nif' => 'nullable|string|max:30|unique:pessoas,nif,' . $pessoa->id,

            'data_nascimento' => 'nullable|date',

            'sexo' => 'nullable|in:Masculino,Feminino',

            'telefone' => 'nullable|string|max:30',

            'email' => 'nullable|email|max:255',

            'morada' => 'nullable|string',

            'fotografia' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'ativo' => 'nullable|boolean',

        ]);


        $validated['ativo'] = $request->boolean('ativo');


        // Nova fotografia
        if ($request->hasFile('fotografia')) {

            // Apagar fotografia antiga
            if ($pessoa->fotografia) {

                Storage::disk('public')
                    ->delete($pessoa->fotografia);
            }


            $validated['fotografia'] =
                $request->file('fotografia')
                    ->store('pessoas', 'public');
        }


        $pessoa->update($validated);


        return redirect()
            ->route('pessoas.index')
            ->with('success', 'Pessoa atualizada com sucesso.');
    }


    /**
     * Remove uma pessoa.
     */
    public function destroy(Pessoa $pessoa)
    {
        // Não permite eliminar pessoa que possui patrimónios.
        if ($pessoa->patrimonios()->exists()) {

            return redirect()
                ->route('pessoas.index')
                ->with(
                    'error',
                    'Esta pessoa possui patrimónios associados e não pode ser eliminada.'
                );
        }


        // Apagar fotografia
        if ($pessoa->fotografia) {

            Storage::disk('public')
                ->delete($pessoa->fotografia);
        }


        $pessoa->delete();


        return redirect()
            ->route('pessoas.index')
            ->with('success', 'Pessoa eliminada com sucesso.');
    }
}