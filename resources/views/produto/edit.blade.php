@extends('layouts.default')

@section('titulo')
    EDITAR PRODUTO
@endsection

@section('conteudo')

<h1>Editar Produto</h1>

<div class="col-6">
    <form action="{{url('produto/update')}}" method="post">
        @csrf
        
        <input type="hidden" name="id" value="{{$produto->id}}">

        <div class="mb-3">
            <label>Categoria:</label>
            <select name="categoria" class="form-select"  required>
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}" {{ $categoria->id == $produto->categoria()->first()->id ? 'selected' : '' }}>{{$categoria->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="mb-3">
                <label>Produto:</label>
                <input type="text" name="nome" value="{{$produto->nome}}" class="form-control" required>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary">Alterar</button>
            <a href="{{url('produtos')}}" class="btn btn-danger">Voltar</a>
        </div>
    </form>
</div>

@endsection