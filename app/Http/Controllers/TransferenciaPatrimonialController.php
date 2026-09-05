<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\Patrimonio;
use App\Models\TransferenciaPatrimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\AuditoriaService;

class TransferenciaPatrimonialController extends Controller
{
    /**
     * Lista o histórico de transferências patrimoniais.
     */
    public function index()
    {
        $transferencias = TransferenciaPatrimonial::with([
            'patrimonio',
            'proprietarioAnterior',
            'novoProprietario',
        ])
        ->orderByDesc('data_transferencia')
        ->orderByDesc('id')
        ->get();

        return view(
            'transferencias_patrimoniais.index',
            compact('transferencias')
        );
    }


    /**
     * Mostra o formulário para uma nova transferência.
     */
    public function create()
    {
        $patrimonios = Patrimonio::with('pessoa')
            ->orderBy('codigo')
            ->get();

        $pessoas = Pessoa::where('ativo', true)
            ->orderBy('nome_completo')
            ->get();

        return view(
            'transferencias_patrimoniais.create',
            compact('patrimonios', 'pessoas')
        );
    }


    /**
     * Registra uma nova transferência patrimonial.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'patrimonio_id' => [
                'required',
                'exists:patrimonios,id'
            ],

            'novo_proprietario_id' => [
                'required',
                'exists:pessoas,id'
            ],

            'data_transferencia' => [
                'required',
                'date'
            ],

            'observacao' => [
                'nullable',
                'string'
            ],

        ]);


        DB::transaction(function () use ($validated) {

            /*
            |----------------------------------------------------------------------
            | Localizar o património com bloqueio durante a transferência
            |----------------------------------------------------------------------
            */

            $patrimonio = Patrimonio::with('pessoa')
                ->lockForUpdate()
                ->findOrFail($validated['patrimonio_id']);


            /*
            |----------------------------------------------------------------------
            | Verificar se existe proprietário atual
            |----------------------------------------------------------------------
            */

            if (!$patrimonio->pessoa_id) {

                throw \Illuminate\Validation\ValidationException::withMessages([
                    'patrimonio_id' =>
                        'Este património não possui um proprietário atual definido.'
                ]);

            }


            /*
            |----------------------------------------------------------------------
            | Impedir transferência para o próprio proprietário
            |----------------------------------------------------------------------
            */

            if (
                (int) $patrimonio->pessoa_id ===
                (int) $validated['novo_proprietario_id']
            ) {

                throw \Illuminate\Validation\ValidationException::withMessages([
                    'novo_proprietario_id' =>
                        'O novo proprietário deve ser diferente do proprietário atual.'
                ]);

            }


            /*
            |----------------------------------------------------------------------
            | Confirmar que o novo proprietário está ativo
            |----------------------------------------------------------------------
            */

            $novoProprietario = Pessoa::where('id', $validated['novo_proprietario_id'])
                ->where('ativo', true)
                ->first();

            if (!$novoProprietario) {

                throw \Illuminate\Validation\ValidationException::withMessages([
                    'novo_proprietario_id' =>
                        'O novo proprietário selecionado não está ativo.'
                ]);

            }
                   $proprietarioAnterior = $patrimonio->pessoa;

            /*
            |----------------------------------------------------------------------
            | Guardar o proprietário atual no histórico
            |----------------------------------------------------------------------
            */

            $transferencia = TransferenciaPatrimonial::create([

                'patrimonio_id' =>
                    $patrimonio->id,

                'proprietario_anterior_id' =>
                    $patrimonio->pessoa_id,

                'novo_proprietario_id' =>
                    $validated['novo_proprietario_id'],

                'data_transferencia' =>
                    $validated['data_transferencia'],

                'observacao' =>
                    $validated['observacao'] ?? null,

            ]);


            /*
            |----------------------------------------------------------------------
            | Atualizar o proprietário atual do património
            |----------------------------------------------------------------------
            */

            $patrimonio->update([

                'pessoa_id' =>
                    $validated['novo_proprietario_id'],

            ]);


            AuditoriaService::registrar(
    'transferir',
    'transferencias',
    "Património {$patrimonio->codigo} transferido de {$proprietarioAnterior->nome_completo} para {$novoProprietario->nome_completo}.",
    $transferencia,
    [
        'patrimonio_id' => $patrimonio->id,
        'proprietario_anterior_id' => $proprietarioAnterior->id,
    ],
    [
        'patrimonio_id' => $patrimonio->id,
        'novo_proprietario_id' => $novoProprietario->id,
        'data_transferencia' => $validated['data_transferencia'],
        'observacao' => $validated['observacao'] ?? null,
    ]
);

        });

        


        return redirect()
            ->route('transferencias-patrimoniais.index')
            ->with(
                'success',
                'Transferência patrimonial registada com sucesso.'
            );
    }
    /**
 * Mostra os detalhes de uma transferência.
 */
public function show(TransferenciaPatrimonial $transferencia)
{
    $transferencia->load([
        'patrimonio',
        'proprietarioAnterior',
        'novoProprietario',
    ]);

    return view(
        'transferencias_patrimoniais.show',
        compact('transferencia')
    );
}
}