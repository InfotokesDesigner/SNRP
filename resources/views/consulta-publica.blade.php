@extends('layouts.snrp.app')

@section('title', 'Consulta Pública - SNRP')

@section('content')

<div class="container-fluid py-4">

    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-primary text-white text-center py-4">

                    <div class="mb-2">
                        <i class="fas fa-search fa-2x"></i>
                    </div>

                    <h2 class="mb-1">
                        Consulta Pública
                    </h2>

                    <p class="mb-0">
                        Sistema de Registo Patrimonial — SNRP
                    </p>

                </div>

                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">

                        <h4>
                            Consulte um Património
                        </h4>

                        <p class="text-muted">
                            Introduza o código do património para consultar
                            as informações públicas disponíveis.
                        </p>

                    </div>

                   <form method="GET"
      onsubmit="return consultarPatrimonio(event);">
                        <div class="form-group">

                            <label for="codigo">
                                Código do Património
                            </label>

                            <div class="input-group input-group-lg">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-qrcode"></i>
                                    </span>
                                </div>

                                <input
                                    type="text"
                                    id="codigo"
                                    name="codigo"
                                    class="form-control"
                                    placeholder="Ex.: SNRP-CAS-000001"
                                    autocomplete="off"
                                    required
                                >

                            </div>

                            <small class="form-text text-muted">
                                Digite o código exatamente como aparece no
                                património ou no QR Code.
                            </small>

                        </div>

                        <div class="text-center mt-4">

                            <button type="submit"
                                    class="btn btn-primary btn-lg px-5">

                                <i class="fas fa-search mr-2"></i>
                                Consultar Património

                            </button>

                        </div>

                    </form>

                </div>

                <div class="card-footer text-center bg-light">

                    <small class="text-muted">
                        Consulta pública do Sistema de Registo Patrimonial
                        (SNRP).
                    </small>

                </div>

            </div>

        </div>
    </div>

</div>

<script>
function consultarPatrimonio(event) {
    event.preventDefault();

    const codigo = document.getElementById('codigo').value.trim();

    if (!codigo) {
        return false;
    }

    window.location.href =
        "{{ url('/consulta-patrimonio') }}/" +
        encodeURIComponent(codigo);

    return false;
}
</script>

@endsection