@extends('layouts.default')

@section('titulo')
    PRODUTOS
@endsection

@section('conteudo')

    <h1>PRODUTOS</h1>

    <a href="{{url('produto/create')}}" class="btn btn-primary mb-2">Cadastrar</a>

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

    <table class="table table-success table-hover">
        <thead class="table-dark">
            <tr>
                <th width="5%">ID</th>
                <th>CATEGORIA</th>
                <th>PRODUTO</th>
                <th width="15%" colspan="2">AÇÕES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
            <tr>
                <td>{{$produto->id}}</td>
                <td>{{$produto->categoria->nome}}</td>
                <td>{{$produto->nome}}</td>
                <td>
                    <a href="{{url('produto')}}/{{$produto->id}}" class="btn btn-warning">Editar</a>
                </td>
                <td>
                    <form onsubmit="deletar(event, this)" action="{{url('produto/delete')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$produto->id}}">
                        <button class="btn btn-danger">Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection

<script>
    function deletar(event, form){
        event.preventDefault();

        if(confirm('Deseja realmente remover este produto?')){
            form.submit();
        }
    }
</script>