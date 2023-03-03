@extends('layouts.default')

@section('titulo')
    ENCERRAR CONTA CLIENTE
@endsection

@section('conteudo')

    <h1>ENCERRAR CONTA</h1>
    
        <div class="col-5 mb-3">
            <label>Nº de Identificação:</label>
            <input type="text" class="form-control" id="identificacao" name="identificacao" placeholder="Ex: 123">
        </div>
        <div class="mb-3">
            <button type="button" onclick="encerrarConta()" class="btn btn-primary">Prosseguir</button>
        </div>

<script>

    var identificacao = document.getElementById('identificacao');

    function encerrarConta(){
        window.location = "{{url('encerrarconta')}}/" + identificacao.value; 
    }
</script>

@endsection