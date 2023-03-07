@extends('layouts.default')

@section('titulo')
    ITENS DA COMANDA
@endsection

@section('conteudo')


<h1>
    Nº DE IDENTIFICAÇÃO: {{$cliente->identificacao}}
    <span class="mt-2" style="float: right; font-size: 20px; font-weight: normal;">
        Saldo do cliente: R$ {{$cliente->saldo}}
    </span>
</h1>

    Cliente: {{$cliente->nome}} <br>
    

<a href="#" class="btn btn-danger">ENCERRAR CONTA</a>

<table class="table table-success table-hover mt-2">
    <thead>
        <tr>
            <th>Nº Pedido</th>
            <th>Qtd</th>
            <th>Itens</th>
            <th>Valor Unitário</th>
            <th>Valor por quantidade</th>
            <th>Data</th>
        </tr>
    </thead>
    <tbody>
        @foreach($itensDoPedido as $itens)
        <tr>
            <td>{{$itens->id_pedido}}</td>
            <td>{{$itens->qtd}}</td>
            <td>{{$itens->produto}}</td>
            <td>{{number_format($itens->valor, 2,',','.')}}</td>
            <td>{{number_format($itens->valorTotal, 2,',','.')}}</td>
            <td>{{$itens->data}}</td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection