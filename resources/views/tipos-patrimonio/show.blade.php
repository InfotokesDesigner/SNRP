@extends('layouts.snrp.app')

@section('title', 'Detalhes do Tipo - SNRP')

@section('page-title', 'Detalhes do Tipo de Património')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title mb-0">
            {{ $tipoPatrimonio->nome }}
        </h3>

        <a href="{{ route('tipos-patrimonio.edit', $tipoPatrimonio) }}"
           class="btn btn-warning">

            <i class="bi bi-pencil me-1"></i>

            Editar

        </a>

    </div>


    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="fw-bold">
                    Nome
                </label>

                <p class="form-control-plaintext">
                    {{ $tipoPatrimonio->nome }}
                </p>

            </div>


            <div class="col-md-6 mb-3">

                <label class="fw-bold">
                    Estado
                </label>

                <p>

                    @if($tipoPatrimonio->ativo)

                        <span class="badge text-bg-success">
                            Ativo
                        </span>

                    @else

                        <span class="badge text-bg-secondary">
                            Inativo
                        </span>

                    @endif

                </p>

            </div>


            <div class="col-12 mb-3">

                <label class="fw-bold">
                    Descrição
                </label>

                <p class="form-control-plaintext">

                    {{ $tipoPatrimonio->descricao ?? 'Nenhuma descrição registada.' }}

                </p>

            </div>


            <div class="col-md-6 mb-3">

                <label class="fw-bold">
                    Total de Patrimónios
                </label>

                <p class="form-control-plaintext">

                    {{ $tipoPatrimonio->patrimonios()->count() }}

                </p>

            </div>

        </div>

    </div>


    <div class="card-footer">

        <a href="{{ route('tipos-patrimonio.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left me-1"></i>

            Voltar

        </a>

    </div>

</div>

@endsection