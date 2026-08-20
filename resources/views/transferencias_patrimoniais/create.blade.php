@extends('layouts.snrp.app')

@section('title', 'Nova Transferência')

@section('page-title', 'Nova Transferência Patrimonial')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title mb-0">
                    Registrar Transferência Patrimonial
                </h3>
            </div>

            <form action="{{ route('transferencias-patrimoniais.store') }}"
                  method="POST">

                @csrf

                <div class="card-body">

                    {{-- Mensagens de validação --}}
                    @if($errors->any())

                        <div class="alert alert-danger">

                            <strong>
                                Verifique os seguintes erros:
                            </strong>

                            <ul class="mb-0 mt-2">

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    {{-- Património --}}
                    <div class="mb-3">

                        <label for="patrimonio_id"
                               class="form-label">

                            Património
                            <span class="text-danger">*</span>

                        </label>

                        <select name="patrimonio_id"
                                id="patrimonio_id"
                                class="form-select @error('patrimonio_id') is-invalid @enderror"
                                required>

                            <option value="">
                                -- Selecionar património --
                            </option>

                            @foreach($patrimonios as $patrimonio)

                                <option value="{{ $patrimonio->id }}"
                                    data-proprietario="{{ $patrimonio->pessoa_id }}"
                                    {{ old('patrimonio_id') == $patrimonio->id ? 'selected' : '' }}>

                                    {{ $patrimonio->codigo }}
                                    —
                                    {{ $patrimonio->nome }}

                                    @if($patrimonio->pessoa)
                                        — Proprietário:
                                        {{ $patrimonio->pessoa->nome_completo }}
                                    @endif

                                </option>

                            @endforeach

                        </select>

                        @error('patrimonio_id')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Proprietário atual --}}
                    <div class="mb-3">

                        <label for="proprietario_atual"
                               class="form-label">

                            Proprietário atual

                        </label>

                        <input type="text"
                               id="proprietario_atual"
                               class="form-control"
                               value=""
                               readonly
                               placeholder="Selecione primeiro o património">

                    </div>


                    {{-- Novo proprietário --}}
                    <div class="mb-3">

                        <label for="novo_proprietario_id"
                               class="form-label">

                            Novo proprietário
                            <span class="text-danger">*</span>

                        </label>

                        <select name="novo_proprietario_id"
                                id="novo_proprietario_id"
                                class="form-select @error('novo_proprietario_id') is-invalid @enderror"
                                required>

                            <option value="">
                                -- Selecionar novo proprietário --
                            </option>

                            @foreach($pessoas as $pessoa)

                                <option value="{{ $pessoa->id }}"
                                    {{ old('novo_proprietario_id') == $pessoa->id ? 'selected' : '' }}>

                                    {{ $pessoa->nome_completo }}

                                    @if($pessoa->codigo_cidadao)
                                        — {{ $pessoa->codigo_cidadao }}
                                    @endif

                                </option>

                            @endforeach

                        </select>

                        @error('novo_proprietario_id')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Data --}}
                    <div class="mb-3">

                        <label for="data_transferencia"
                               class="form-label">

                            Data da transferência
                            <span class="text-danger">*</span>

                        </label>

                        <input type="date"
                               name="data_transferencia"
                               id="data_transferencia"
                               class="form-control @error('data_transferencia') is-invalid @enderror"
                               value="{{ old('data_transferencia', now()->format('Y-m-d')) }}"
                               required>

                        @error('data_transferencia')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Observação --}}
                    <div class="mb-3">

                        <label for="observacao"
                               class="form-label">

                            Observação

                        </label>

                        <textarea name="observacao"
                                  id="observacao"
                                  rows="4"
                                  class="form-control @error('observacao') is-invalid @enderror"
                                  placeholder="Digite uma observação sobre a transferência...">{{ old('observacao') }}</textarea>

                        @error('observacao')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                <div class="card-footer d-flex justify-content-between">

                    <a href="{{ route('transferencias-patrimoniais.index') }}"
                       class="btn btn-secondary">

                        <i class="bi bi-arrow-left"></i>
                        Cancelar

                    </a>

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="bi bi-check-circle"></i>
                        Registrar Transferência

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- Atualiza automaticamente o proprietário atual --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const patrimonioSelect =
        document.getElementById('patrimonio_id');

    const proprietarioAtual =
        document.getElementById('proprietario_atual');

    const pessoas = @json(
        $pessoas->pluck('nome_completo', 'id')
    );

    patrimonioSelect.addEventListener('change', function () {

        const selectedOption =
            this.options[this.selectedIndex];

        const proprietarioId =
            selectedOption.dataset.proprietario;

        if (proprietarioId && pessoas[proprietarioId]) {

            proprietarioAtual.value =
                pessoas[proprietarioId];

        } else {

            proprietarioAtual.value =
                'Sem proprietário definido';

        }

    });

    // Executa automaticamente se houver valor antigo
    if (patrimonioSelect.value) {

        patrimonioSelect.dispatchEvent(
            new Event('change')
        );

    }

});

</script>

@endsection