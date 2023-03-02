@extends('layouts.default')

@section('titulo')
    CADASTRO DE CATEGORIAS
@endsection

@section('conteudo')
    

        <h1>CADASTRAR CATEGORIA</h1>

        <div class="col-6">
            <form action="{{url('categoria/store')}}" method="post">
                @csrf                
                <div class="mb-3">
                    <label>Categoria:</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary">Salvar</button>
                    <a href="{{url('categorias')}}" class="btn btn-danger">Voltar</a>
                </div>
            </form>
        </div>
@endsection