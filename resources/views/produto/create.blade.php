@extends('layouts.default')

@section('titulo')
    CADASTRAR PRODUTO
@endsection

@section('conteudo')

<h1>Cadastrar Produto</h1>

<div class="col-6">
    <form action="{{url('produto/store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label>Categoria:</label>
            <select name="categoria" class="form-select" required>
                <option value="">Selecione...</option>
                @foreach($categorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="mb-3">
                <label>Produto:</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary">Salvar</button>
            <a href="{{url('produtos')}}" class="btn btn-danger">Voltar</a>
        </div>
    </form>
</div>

@endsection