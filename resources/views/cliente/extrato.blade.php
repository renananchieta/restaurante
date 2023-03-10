@extends('layouts.default')

@section('titulo')
    EXTRATO DO CLIENTE
@endsection

@section('conteudo')

    <h1>
        EXTRATO DO CLIENTE:
        <span class="mt-2" style="float: right; font-size: 20px; font-weight: normal;">
            {{$cliente->nome}}
        </span>
    </h1>

    <a href="{{url('clientes')}}" class="btn btn-danger mb-2">Voltar</a>

    <table class="table table-success table-hover">
        <thead class="table-dark">
            <tr>
                <th>DATA</th>
                <th>OBSERVAÇÃO</th>
                <th>VALOR (R$)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($extrato as $i)
            <tr>
                <td>{{$i->data}}</td>
                <td>{{$i->observacao}}</td>
                <td>
                    @if($i->fk_tipo_movimentacao == 1)
                        <span style="color: green"> {{ number_format($i->valor, 2, ',', '.') }}</span>
                    @else
                        <span style="color: red">-{{ number_format($i->valor, 2, ',', '.')}}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection