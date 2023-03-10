@extends('layouts.default')

@section('titulo')
    EDITAR CARDÁPIO
@endsection

@section('conteudo')

<h1>EDITAR CARDÁPIO</h1>

<div class="col-6">
    <form action="{{url('cardapio/update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$cardapio->id}}">
        <div class="mb-3">
            <label>Produto:</label>
            <select name="produto" class="form-select"  required>
                @foreach($produtos as $produto)
                <option value="{{$produto->id}}" {{$produto->id == $cardapio->produto()->first()->id ? 'selected' : ''}} >{{$produto->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="col-6">
                <label>Valor:</label>
                <input type="float" name="valor" value="{{$cardapio->valor}}" class="form-control" placeholder="R$" required>
            </div>
            <div class="col-12 mb-2">
                <label>Descrição:</label>
                <textarea name="descricao" id="" cols="30" rows="10" class="form-control" placeholder="Descrição do produto">{{$cardapio->descricao}}</textarea>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary">Alterar</button>
            <a href="{{url('cardapio')}}" class="btn btn-danger">Voltar</a>
        </div>
    </form>
</div>

@endsection