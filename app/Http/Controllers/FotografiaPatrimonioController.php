<?php

namespace App\Http\Controllers;

use App\Models\FotografiaPatrimonio;
use App\Models\Patrimonio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotografiaPatrimonioController extends Controller
{
    /**
     * Guarda uma nova fotografia do património.
     */
    public function store(Request $request, Patrimonio $patrimonio)
    {
        $validated = $request->validate([
            'fotografia' => [
                'required',
                'image',
                'mimes:jpeg,jpg,png,webp',
                'max:5120',
            ],

            'descricao' => [
                'nullable',
                'string',
                'max:255',
            ],

            'principal' => [
                'nullable',
                'boolean',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Guardar a fotografia
        |--------------------------------------------------------------------------
        */

        $arquivo = $request->file('fotografia');

        $caminho = $arquivo->store(
            'patrimonios/' . $patrimonio->id,
            'public'
        );

        /*
        |--------------------------------------------------------------------------
        | Se for fotografia principal, retirar principal das anteriores
        |--------------------------------------------------------------------------
        */

        $principal = $request->boolean('principal');

        if ($principal) {
            $patrimonio->fotografias()
                ->update([
                    'principal' => false,
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Criar registo da fotografia
        |--------------------------------------------------------------------------
        */

        FotografiaPatrimonio::create([
            'patrimonio_id' => $patrimonio->id,
            'caminho' => $caminho,
            'nome_original' => $arquivo->getClientOriginalName(),
            'descricao' => $validated['descricao'] ?? null,
            'principal' => $principal,
        ]);

        return redirect()
            ->route('patrimonios.show', $patrimonio)
            ->with(
                'success',
                'Fotografia adicionada com sucesso.'
            );
    }


    /**
     * Elimina uma fotografia do património.
     */
  /**
 * Elimina uma fotografia do património.
 */
public function destroy(
    Patrimonio $patrimonio,
    FotografiaPatrimonio $fotografia
) {
    /*
    |--------------------------------------------------------------------------
    | Garantir que a fotografia pertence ao património
    |--------------------------------------------------------------------------
    */

    if ($fotografia->patrimonio_id !== $patrimonio->id) {
        abort(404);
    }

    /*
    |--------------------------------------------------------------------------
    | Verificar se a fotografia eliminada é a principal
    |--------------------------------------------------------------------------
    */

    $eraPrincipal = $fotografia->principal;

    /*
    |--------------------------------------------------------------------------
    | Apagar o arquivo físico
    |--------------------------------------------------------------------------
    */

    if ($fotografia->caminho) {
        Storage::disk('public')->delete(
            $fotografia->caminho
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Apagar o registo da base de dados
    |--------------------------------------------------------------------------
    */

    $fotografia->delete();

    /*
    |--------------------------------------------------------------------------
    | Se era a principal, escolher outra fotografia
    |--------------------------------------------------------------------------
    */

    if ($eraPrincipal) {

        $novaPrincipal = $patrimonio->fotografias()
            ->orderBy('created_at')
            ->first();

        if ($novaPrincipal) {

            $novaPrincipal->update([
                'principal' => true,
            ]);

        }
    }

    return redirect()
        ->route('patrimonios.show', $patrimonio)
        ->with(
            'success',
            'Fotografia eliminada com sucesso.'
        );
}
    /**
 * Define uma fotografia como principal.
 */
public function principal(
    Patrimonio $patrimonio,
    FotografiaPatrimonio $fotografia
) {
    /*
    |--------------------------------------------------------------------------
    | Garantir que a fotografia pertence ao património
    |--------------------------------------------------------------------------
    */

    if ($fotografia->patrimonio_id !== $patrimonio->id) {
        abort(404);
    }

    /*
    |--------------------------------------------------------------------------
    | Retirar o estado de principal das fotografias anteriores
    |--------------------------------------------------------------------------
    */

    $patrimonio->fotografias()->update([
        'principal' => false,
    ]);

    /*
    |--------------------------------------------------------------------------
    | Definir a fotografia selecionada como principal
    |--------------------------------------------------------------------------
    */

    $fotografia->update([
        'principal' => true,
    ]);

    return redirect()
        ->route('patrimonios.show', $patrimonio)
        ->with(
            'success',
            'Fotografia principal atualizada com sucesso.'
        );
}
}