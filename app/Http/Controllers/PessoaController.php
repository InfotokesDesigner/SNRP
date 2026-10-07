<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\User;
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
    $utilizadores = User::where('ativo', true)
        ->orderBy('name')
        ->get();

    return view(
        'pessoas.create',
        compact('utilizadores')
    );
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


    /*
    |--------------------------------------------------------------------------
    | Geração automática do código do cidadão
    |--------------------------------------------------------------------------
    */

    $ultimoCodigo = Pessoa::whereNotNull('codigo_cidadao')
        ->orderByDesc('id')
        ->value('codigo_cidadao');


    if ($ultimoCodigo) {

        $numero = (int) substr($ultimoCodigo, -6);

        $novoNumero = $numero + 1;

    } else {

        $novoNumero = 1;

    }


    $validated['codigo_cidadao'] =
        'SNRP-PES-' . str_pad(
            $novoNumero,
            6,
            '0',
            STR_PAD_LEFT
        );


    // Estado
    $validated['ativo'] = $request->boolean('ativo');


    /*
    |--------------------------------------------------------------------------
    | Upload da fotografia
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('fotografia')) {

        $validated['fotografia'] =
            $request->file('fotografia')
                ->store('pessoas', 'public');
    }


    /*
    |--------------------------------------------------------------------------
    | Criar pessoa
    |--------------------------------------------------------------------------
    */

    Pessoa::create($validated);


    return redirect()
        ->route('pessoas.index')
        ->with(
            'success',
            'Pessoa cadastrada com sucesso. Código: '
            . $validated['codigo_cidadao']
        );
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
    $utilizadores = User::where('ativo', true)
        ->orderBy('name')
        ->get();

    return view(
        'pessoas.edit',
        compact('pessoa', 'utilizadores')
    );
}

    /**
     * Atualiza uma pessoa.
     */
   public function update(Request $request, Pessoa $pessoa)
{
    $validated = $request->validate([

        'user_id' => [
            'nullable',
            'exists:users,id',
            'unique:pessoas,user_id,' . $pessoa->id,
        ],

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

    /*
    |--------------------------------------------------------------------------
    | Nova fotografia
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('fotografia')) {

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
        ->with(
            'success',
            'Pessoa atualizada com sucesso.'
        );
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

    public function bibliotecaPatrimonial(Pessoa $pessoa)
{
    $pessoa->load([
        'patrimonios' => function ($query) {
            $query->with('tipoPatrimonio')
                ->orderBy('codigo');
        }
    ]);

    return view(
        'pessoas.biblioteca-patrimonial',
        compact('pessoa')
    );
}



public function biblioteca(Request $request)
{
    $termo = trim($request->input('q', ''));

    $pessoas = collect();

    if ($termo !== '') {
        $pessoas = Pessoa::query()
            ->withCount('patrimonios')
            ->where(function ($query) use ($termo) {

                $query->where('nome_completo', 'like', "%{$termo}%")
                    ->orWhere('nif', 'like', "%{$termo}%")
                    ->orWhere('codigo_cidadao', 'like', "%{$termo}%");

                if (is_numeric($termo)) {
                    $query->orWhere('id', (int) $termo);
                }

            })
            ->orderBy('nome_completo')
            ->get();
    }

    return view(
        'biblioteca-patrimonial.index',
        compact('pessoas', 'termo')
    );
}
}