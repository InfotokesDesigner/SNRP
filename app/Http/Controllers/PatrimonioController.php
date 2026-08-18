<?php

namespace App\Http\Controllers;

use App\Models\Patrimonio;
use App\Models\Pessoa;
use App\Models\Instituicao;
use App\Models\TipoPatrimonio;
use Illuminate\Http\Request;

class PatrimonioController extends Controller
{
    /**
     * Lista os patrimónios.
     */
    public function index(Request $request)
    {
        $pesquisa = $request->input('pesquisa');

        $patrimonios = Patrimonio::with([
                'tipoPatrimonio',
                'pessoa',
                'instituicao'
            ])
            ->when($pesquisa, function ($query, $pesquisa) {

                $query->where(function ($q) use ($pesquisa) {

                    $q->where('codigo', 'like', "%{$pesquisa}%")
                        ->orWhere('nome', 'like', "%{$pesquisa}%")
                        ->orWhere('localizacao', 'like', "%{$pesquisa}%");

                });

            })
            ->orderBy('nome')
            ->paginate(10)
            ->withQueryString();

        return view(
            'patrimonios.index',
            compact('patrimonios')
        );
    }


    /**
     * Formulário para cadastrar património.
     */
    public function create()
    {
        $pessoas = Pessoa::where('ativo', true)
            ->orderBy('nome_completo')
            ->get();

        $instituicoes = Instituicao::where('ativo', true)
            ->orderBy('nome')
            ->get();

        $tipos = TipoPatrimonio::where('ativo', true)
            ->orderBy('nome')
            ->get();

        return view(
            'patrimonios.create',
            compact(
                'pessoas',
                'instituicoes',
                'tipos'
            )
        );
    }


    /**
     * Guarda um novo património.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'codigo' => [
                'required',
                'string',
                'max:50',
                'unique:patrimonios,codigo'
            ],

            'tipo_patrimonio_id' => [
                'required',
                'exists:tipo_patrimonios,id'
            ],

            'pessoa_id' => [
                'required',
                'exists:pessoas,id'
            ],

            'instituicao_id' => [
                'required',
                'exists:instituicoes,id'
            ],

            'nome' => [
                'required',
                'string',
                'max:255'
            ],

            'descricao' => [
                'nullable',
                'string'
            ],

            'localizacao' => [
                'nullable',
                'string'
            ],

            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90'
            ],

            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180'
            ],

            'estado' => [
                'required',
                'in:Ativo,Transferido,Inativo'
            ],

        ]);

        Patrimonio::create($validated);

        return redirect()
            ->route('patrimonios.index')
            ->with(
                'success',
                'Património cadastrado com sucesso.'
            );
    }


    /**
     * Mostra os dados do património.
     */
    public function show(Patrimonio $patrimonio)
    {
        $patrimonio->load([
            'tipoPatrimonio',
            'pessoa',
            'instituicao'
        ]);

        return view(
            'patrimonios.show',
            compact('patrimonio')
        );
    }


    /**
     * Formulário de edição.
     */
    public function edit(Patrimonio $patrimonio)
    {
        $pessoas = Pessoa::where('ativo', true)
            ->orderBy('nome_completo')
            ->get();

        $instituicoes = Instituicao::where('ativo', true)
            ->orderBy('nome')
            ->get();

        $tipos = TipoPatrimonio::where('ativo', true)
            ->orderBy('nome')
            ->get();

        return view(
            'patrimonios.edit',
            compact(
                'patrimonio',
                'pessoas',
                'instituicoes',
                'tipos'
            )
        );
    }


    /**
     * Atualiza um património.
     */
    public function update(
        Request $request,
        Patrimonio $patrimonio
    ) {
        $validated = $request->validate([

            'codigo' => [
                'required',
                'string',
                'max:50',
                'unique:patrimonios,codigo,' . $patrimonio->id
            ],

            'tipo_patrimonio_id' => [
                'required',
                'exists:tipo_patrimonios,id'
            ],

            'pessoa_id' => [
                'required',
                'exists:pessoas,id'
            ],

            'instituicao_id' => [
                'required',
                'exists:instituicoes,id'
            ],

            'nome' => [
                'required',
                'string',
                'max:255'
            ],

            'descricao' => [
                'nullable',
                'string'
            ],

            'localizacao' => [
                'nullable',
                'string'
            ],

            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90'
            ],

            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180'
            ],

            'estado' => [
                'required',
                'in:Ativo,Transferido,Inativo'
            ],

        ]);

        $patrimonio->update($validated);

        return redirect()
            ->route('patrimonios.index')
            ->with(
                'success',
                'Património atualizado com sucesso.'
            );
    }


    /**
     * Elimina um património.
     */
    public function destroy(Patrimonio $patrimonio)
    {
        $patrimonio->delete();

        return redirect()
            ->route('patrimonios.index')
            ->with(
                'success',
                'Património eliminado com sucesso.'
            );
    }
}