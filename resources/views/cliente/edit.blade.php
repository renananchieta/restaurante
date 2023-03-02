@extends('layouts.default')

@section('titulo')
EDITAR CLIENTE
@endsection

@section('conteudo')

<h1>EDITAR CLIENTE</h1>


    <form action="{{url('cliente/update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$cliente->id}}">
        <div class="row">
            <div class="col-5 mb-3">
                <label>Cliente:</label>
                <input type="text" name="nome" value="{{$cliente->nome}}" class="form-control">
            </div>
            <div class="col-3 mb-3">
                <label>Telefone:</label>
                <input type="text" name="telefone" value="{{$cliente->telefone}}" class="form-control">
            </div>
        </div>
        <div class="col-3 mb-3">
            <label>Identificação (comanda):</label>
            <input type="text" name="identificacao" value="{{$cliente->identificacao}}" class="form-control">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Alterar</button>
            <a href="{{url('clientes')}}" class="btn btn-danger">Voltar</a>
        </div>
    </form>

@endsection