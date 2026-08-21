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

        return redirect()
            ->route('patrimonios.show', $patrimonio)
            ->with(
                'success',
                'Fotografia eliminada com sucesso.'
            );
    }
}