@extends('layouts.default')

@section('titulo')
    CARDÁPIO
@endsection

@section('conteudo')

    <h1>Cardápio</h1>

    <a href="{{url('cardapio/create')}}" class="btn btn-primary mb-2">Cadastrar</a>

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
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th>PRODUTO</th>
                <th>DESCRIÇÃO</th>
                <th>VALOR</th>
                <th colspan="2" width="15%">AÇÕES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cardapios as $cardapio)
            <tr>
                <td>{{$cardapio->id}}</td>
                <td>{{$cardapio->produto->nome}}</td>
                <td>{{$cardapio->descricao}}</td>
                <td>R$ {{$cardapio->valor}}</td>
                <td>
                    <a href="{{url('cardapio')}}/{{$cardapio->id}}" class="btn btn-warning">Editar</a>
                </td>
                <td>
                    <form onsubmit="deletar(event, this)" action="{{url('cardapio/delete')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$cardapio->id}}">
                        <button class="btn btn-danger">Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


@endsection

<script>
    function deletar(evet, form){
        event.preventDefault();
        if(confirm('Deseja realmente remover este cardápio?')){
            form.submit();
        }
    }
</script>