@extends('layouts.default')

@section('titulo')
    CATEGORIAS
@endsection

@section('conteudo')

    <h1>CATEGORIAS</h1>

    <a href="{{url('categoria/create')}}" class="btn btn-primary mb-2">Cadastrar</a>

@if(session('mensagem'))
    <div class="alert alert-success">
        {{session('mensagem')}}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif

<table class="table table-success table-hover ">
    <thead>
        <tr>
            <th width="5%">ID</th>
            <th>CATEGORIA</th>
            <th width="15%" colspan="2">AÇÕES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categorias as $categoria)
        <tr>
            <td>{{$categoria->id}}</td>
            <td>{{$categoria->nome}}</td>
            <td>
                <a href="{{url('categoria')}}/{{ $categoria->id }}" class="btn btn-warning">Editar</a>
            </td>
            <td>
                <form onsubmit="return false;" id="formDelete{{$categoria->id}}" action="{{url('categoria/delete')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$categoria->id}}">
                    <button class="btn btn-danger" onclick="deletar(event, `{{$categoria->id}}`)">Deletar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

<script>
    function deletar(event, id) {
        if (confirm('Deseja realmente Remover categoria?')) {
            const form = document.getElementById(`formDelete${id}`);
            form.submit();
        }
    }
</script>