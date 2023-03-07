@extends('layouts.default')

@section('titulo')
    PEDIDOS
@endsection

@section('conteudo')

    <h1>PEDIDOS</h1>

    <a href="{{url('pedido/create')}}" class="btn btn-primary mb-2">Cadastrar</a>

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
                <th width="5%">ID</th>
                <th>DATA</th>
                <th>MESA</th>
                <th>IDENTIFICAÇÃO</th>
                <th>STATUS</th>
                <th width="10%">AÇÃO</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
            <tr>
                <td>{{$pedido->id}}</td>
                <td>{{$pedido->data}}</td>
                <td>{{$pedido->mesa}}</td>
                <td>{{$pedido->cliente->identificacao}}</td>
                <td>{{$pedido->status}}</td>
                <td>
                    <a href="{{url('pedido/detalhes')}}/{{$pedido->id}}" class="btn btn-primary">Visualizar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection