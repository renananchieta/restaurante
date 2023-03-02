@extends('layouts.default')

@section('titulo')
ITENS PEDIDOS
@endsection

@section('conteudo')


<h1 class="mb-2">PEDIDOS A SEREM PREPARADOS</h1>

@if(session('mensagem'))
    <div class="alert alert-success">
        {{session('mensagem')}}
    </div>
@endif


<table class="table table-success table-hover">
    <thead>
        <tr>
            <th width="15%">NÚMERO DO PEDIDO</th>
            <th width="15%">DATA</th>
            <th>MESA</th>
            <th>STATUS</th>
            <th width="15%" colspan="2">AÇÕES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pedido as $itens)
        <tr>
            <td>{{$itens->id}}</td>
            <td>{{$itens->data}}</td>
            <td>{{$itens->mesa}}</td>
            <td>{{$itens->status}}</td>
            <td>
                <a href="{{url('pedido/detalhes')}}/{{$itens->id}}" class="btn btn-primary">Visualizar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection