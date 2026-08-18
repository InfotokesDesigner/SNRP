@extends('layouts.snrp.app')

@section('title', 'Dashboard - SNRP')

@section('page-title', 'Dashboard')

@section('content')

<div class="row">

    {{-- Instituições --}}
    <div class="col-lg-3 col-6">

        <div class="small-box text-bg-primary">

            <div class="inner">

                <h3>
                    {{ \App\Models\Instituicao::count() }}
                </h3>

                <p>Instituições</p>

            </div>

            <div class="small-box-icon">

                <i class="bi bi-building"></i>

            </div>

        </div>

    </div>


    {{-- Pessoas --}}
    <div class="col-lg-3 col-6">

        <div class="small-box text-bg-success">

            <div class="inner">

                <h3>
                    {{ \App\Models\Pessoa::count() }}
                </h3>

                <p>Pessoas</p>

            </div>

            <div class="small-box-icon">

                <i class="bi bi-people"></i>

            </div>

        </div>

    </div>


    {{-- Patrimónios --}}
    <div class="col-lg-3 col-6">

        <div class="small-box text-bg-warning">

            <div class="inner">

                <h3>
                    {{ \App\Models\Patrimonio::count() }}
                </h3>

                <p>Patrimónios</p>

            </div>

            <div class="small-box-icon">

                <i class="bi bi-house"></i>

            </div>

        </div>

    </div>


    {{-- Utilizadores --}}
    <div class="col-lg-3 col-6">

        <div class="small-box text-bg-danger">

            <div class="inner">

                <h3>
                    {{ \App\Models\User::count() }}
                </h3>

                <p>Utilizadores</p>

            </div>

            <div class="small-box-icon">

                <i class="bi bi-person-badge"></i>

            </div>

        </div>

    </div>

</div>


{{-- Mensagem de boas-vindas --}}

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Bem-vindo ao SNRP

        </h3>

    </div>

    <div class="card-body">

        <p class="mb-0">

            <strong>Sistema Nacional de Registo Patrimonial</strong>

            <br>

            Plataforma de registo, organização, consulta e proteção
            dos bens patrimoniais.

        </p>

    </div>

</div>

@endsection