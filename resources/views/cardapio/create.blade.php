@extends('layouts.default')

@section('titulo')
    CADASTRAR CARDÁPIO
@endsection

@section('conteudo')

<h1>CADASTRAR CARDÁPIO</h1>

<div class="col-6">
    <form action="{{url('cardapio/store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label>Produto:</label>
            <select name="produto" class="form-select" required>
                <option>Selecione...</option>
                @foreach($produtos as $produto)
                <option value="{{$produto->id}}">{{$produto->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="col-6">
                <label>Valor:</label>
                <input type="float" name="valor" class="form-control" placeholder="R$" required>
            </div>
            <div class="col-12 mb-2">
                <label>Descrição:</label>
                <textarea name="descricao" id="" cols="30" rows="10" class="form-control" placeholder="Descrição do produto"></textarea>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary">Salvar</button>
            <a href="{{url('cardapio')}}" class="btn btn-danger">Voltar</a>
        </div>
    </form>
</div>

@endsection