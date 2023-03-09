@extends('layouts.default')

@section('titulo')
    TRANSFERÊNCIA DE CRÉDITO
@endsection

@section('conteudo')

<h1>TRANSFERÊNCIA DE CRÉDITO</h1>

@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif

<form onsubmit="transferir(event,this)" action="{{url('transferircredito/concluir')}}" method="post">
    @csrf
    <div class="row mb-3">
        <div class="col-2 mb-3">
            <label>Identificação de origem:</label>
            <input type="text" class="form-control" name="identificacaoOrigem" placeholder="Ex: 123" required>
        </div>
        <div class="col-2 mb-3">
            <label>Valor a ser transferido:</label>
            <input type="text" class="form-control" name="valorDaTransferencia" placeholder="R$" required>
        </div>
    </div>
    <div class="row">
        <div class="col-2 mb-3">
            <label>Identificação de destino:</label>
            <input type="text" class="form-control" name="identificacaoDestino" placeholder="Ex: 123" required>
        </div>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary mb-2">Transferir</button>
    </div>
</form>

<script>
    function transferir(event, form){
        event.preventDefault();

        if(confirm('Deseja realmente realizar esta transferêcia?')){
            form.submit();
        }
    }
</script>

@endsection