@extends('layouts.default')

@section('titulo')
    CLIENTES
@endsection

@section('conteudo')

    <h1>CLIENTES</h1>

    <a href="{{url('cliente/create')}}" class="btn btn-primary mb-2">Cadastrar</a>

    @if(session('mensagem'))
        <div class="alert alert-success">
            {{session('mensagem')}}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif

    <table class="table table-success table-hover">
        <thead>
            <tr>
                <th>CLIENTE</th>
                <th>TELEFONE</th>
                <th>IDENTIFICAÇÃO</th>
                <th width="15%">AÇÕES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{$cliente->nome}}</td>
                <td>{{$cliente->telefone}}</td>
                <td>{{$cliente->identificacao}}</td>
                <td>
                    <a href="{{url('cliente')}}/{{ $cliente->id }}" class="btn btn-warning">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection