@extends('layouts.default')

@section('titulo')
CADASTRAR CLIENTE
@endsection

@section('conteudo')

<h1>CADASTRAR CLIENTE</h1>


    <form action="{{url('cliente/store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-5 mb-3">
                <label>Cliente:</label>
                <input type="text" name="nome" class="form-control">
            </div>
            <div class="col-3 mb-3">
                <label>Telefone:</label>
                <input type="text" name="telefone" class="form-control">
            </div>
        </div>
        <div class="col-3 mb-3">
            <label>Identificação (comanda):</label>
            <input type="text" name="identificacao" class="form-control">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{url('clientes')}}" class="btn btn-danger">Voltar</a>
        </div>
    </form>

@endsection