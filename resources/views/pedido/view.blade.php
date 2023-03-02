@extends('layouts.default')
@section('titulo')
STATUS DO PEDIDO
@endsection

@section('conteudo')

<div>


    <h1>
        NÚMERO DO PEDIDO: {{ $pedido->id }}

        <span class="mt-2" style="float: right; font-size: 20px; font-weight: normal;">
            {{ $pedido->status }}
        </span>
    </h1>


    <div class="row 2">
        <div class="col-1">
            <a href="{{url('pedidos')}}" class="btn btn-primary mb-2">Voltar</a>
        </div>
        <div class="col-1">
            @if($pedido->status == "PENDENTE")
                <form action="{{url('pedido/detalhes/status/pronto')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $pedido->id }}">
                    <button class="btn btn-success mb-2">PRONTO</button>
                </form>
            @endif
        </div>    
        <div class="col-1">
            @if($pedido->status != "CANCELADO")
                <form action="{{url('pedido/cancelar')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $pedido->id }}">
                    <button class="btn btn-danger mb-2">CANCELAR</button>
                </form>
            @endif
        </div>
    </div>
    <table class="table table-success table-hover">
        <thead>
            <tr>
                <th width="15%">QUANTIDADE</th>
                <th>DESCRIÇÃO</th>
            </tr>
        </thead>
        <tbody>
            @foreach($itensDoPedido as $itens)
            <tr>
                <td>{{$itens->qtd}}</td>
                <td>{{$itens->produto}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection