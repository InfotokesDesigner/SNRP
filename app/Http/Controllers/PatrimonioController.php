<?php

namespace App\Http\Controllers;

use App\Models\Patrimonio;
use App\Models\Pessoa;
use App\Models\Instituicao;
use App\Models\TipoPatrimonio;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
    /**
 * Guarda um novo património.
 */
public function store(Request $request)
{
    $validated = $request->validate([

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


    /*
    |--------------------------------------------------------------------------
    | Determinar o prefixo do código
    |--------------------------------------------------------------------------
    */

    $tipo = TipoPatrimonio::findOrFail(
        $validated['tipo_patrimonio_id']
    );

    $prefixos = [
        'Casa' => 'CAS',
        'Terreno' => 'TER',
        'Viatura' => 'VIA',
        'Veículo' => 'VEI',
        'Outro' => 'OUT',
    ];

    $prefixo = $prefixos[$tipo->nome] ?? 'OUT';


    /*
    |--------------------------------------------------------------------------
    | Gerar próximo código do património
    |--------------------------------------------------------------------------
    */

    $ultimoCodigo = Patrimonio::where(
        'codigo',
        'like',
        'SNRP-' . $prefixo . '-%'
    )
    ->orderByDesc('id')
    ->value('codigo');


    if ($ultimoCodigo) {

        $numero = (int) substr($ultimoCodigo, -6);

        $novoNumero = $numero + 1;

    } else {

        $novoNumero = 1;

    }


    $validated['codigo'] =
        'SNRP-' . $prefixo . '-' .
        str_pad(
            $novoNumero,
            6,
            '0',
            STR_PAD_LEFT
        );


    /*
    |--------------------------------------------------------------------------
    | Criar património
    |--------------------------------------------------------------------------
    */

    Patrimonio::create($validated);


    return redirect()
        ->route('patrimonios.index')
        ->with(
            'success',
            'Património cadastrado com sucesso. Código: '
            . $validated['codigo']
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
    'instituicao',
    'transferencias.proprietarioAnterior',
    'transferencias.novoProprietario',
    'fotografias',
]);

    $qrCode = QrCode::size(180)
        ->margin(1)
        ->generate(
            url('/consulta-patrimonio/' . $patrimonio->codigo)
        );

    return view(
        'patrimonios.show',
        compact('patrimonio', 'qrCode')
    );
}


    /**
     * Formulário de edição.
     */
public function edit(Patrimonio $patrimonio)
{
    $user = auth()->user();

    $ehAdministrador = (int) $user->role_id === 1;

    $ehProprietario = $user->pessoa
        && (int) $user->pessoa->id === (int) $patrimonio->pessoa_id;

    if (!$ehAdministrador && !$ehProprietario) {
        abort(403, 'Você não tem autorização para editar este património.');
    }

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
    $user = auth()->user();

    $ehAdministrador = (int) $user->role_id === 1;

    $ehProprietario = $user->pessoa
        && (int) $user->pessoa->id === (int) $patrimonio->pessoa_id;

    if (!$ehAdministrador && !$ehProprietario) {
        abort(403, 'Você não tem autorização para alterar este património.');
    }

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
 * Consulta pública de um património através do código.
 */
/**
 * Consulta pública de um património através do código.
 */
public function consultaPublica(string $codigo)
{
    $patrimonio = Patrimonio::with([
        'tipoPatrimonio',
        'instituicao',
        'fotografias',
    ])
    ->where('codigo', $codigo)
    ->firstOrFail();

    return view(
        'patrimonios.consulta',
        compact('patrimonio')
    );
}

    /**
     * Elimina um património.
     */
   public function destroy(Patrimonio $patrimonio)
{
    $user = auth()->user();

    $ehAdministrador = (int) $user->role_id === 1;

    $ehProprietario = $user->pessoa
        && (int) $user->pessoa->id === (int) $patrimonio->pessoa_id;

    if (!$ehAdministrador && !$ehProprietario) {
        abort(403, 'Você não tem autorização para eliminar este património.');
    }

    $patrimonio->delete();

    return redirect()
        ->route('patrimonios.index')
        ->with(
            'success',
            'Património eliminado com sucesso.'
        );
}

    /**
 * Consulta pública de um património pelo código.
 */
public function consulta($codigo)
{
    $patrimonio = Patrimonio::with([
        'tipoPatrimonio',
        'pessoa',
        'instituicao'
    ])
    ->where('codigo', $codigo)
    ->first();

    if (!$patrimonio) {
        abort(404, 'Património não encontrado.');
    }

    return view(
        'patrimonios.consulta',
        compact('patrimonio')
    );
}

public function certificado(Patrimonio $patrimonio)
{
    $patrimonio->load([
        'pessoa',
        'tipoPatrimonio',
        'instituicao',
    ]);

    return view(
        'patrimonios.certificado',
        compact('patrimonio')
    );
}
}