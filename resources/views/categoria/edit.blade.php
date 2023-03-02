@extends('layouts.default')

@section('titulo')
    EDITAR CATEGORIAS
@endsection

@section('conteudo')

        <h1>EDITAR CATEGORIA</h1>

        <div class="col-6">
            <form action="{{url('categoria/update')}}" method="post">
                @csrf           
                
                <input type="hidden" name="id" value="{{$categoria->id}}">

                <div class="mb-3">
                    <label>Categoria:</label>
                    <input type="text" name="nome" value="{{ $categoria->nome }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary">Alterar</button>
                    <a href="{{url('categorias')}}" class="btn btn-danger">Voltar</a>
                </div>
            </form>
        </div>

    </div>
@endsection