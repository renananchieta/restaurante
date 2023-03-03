@extends('layouts.default')

@section('titulo')
    ITENS DA COMANDA
@endsection

@section('conteudo')

    <h1>Nº DE IDENTIFICAÇÃO: {{$cliente->identificacao}} </h1>

    Cliente: {{$cliente->nome}}

    <table class="table table-success table-hover mt-2">
        <thead>
            <tr>
                <th>Nº Pedido</th>
                <th>Qtd</th>
                <th>Itens</th>
                <th>Valor</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($itensDoPedido as $itens)
            <tr>
                <td>{{$itens->id_pedido}}</td>
                <td>{{$itens->qtd}}</td>
                <td>{{$itens->produto}}</td>
                <td>{{$itens->valor}}</td>
                <td>{{$itens->data}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection