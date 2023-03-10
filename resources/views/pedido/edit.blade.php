@extends('layouts.default')

@section('titulo')
    EDITAR PEDIDO
@endsection

@section('conteudo')

    <h1>EDITAR PEDIDO</h1>

    <form action="{{url('pedido/update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$pedido->id}}">
        <div class="row mb-3">
            <!-- <div class=" col-2 mb-3">
                <label>Data:</label>
                <input type="date" name="data" class="form-control">
            </div> -->
            <div class="col-2">
                <label>Mesa:</label>
                <input type="text" name="mesa" value="{{$pedido->mesa}}" class="form-control">
            </div>
            <div class="col-2">
                <label>Status:</label>
                <select name="status" class="form-select">
                    <option value="PENDENTE" selected>Pendente</option>
                    <option value="PRONTO">Pronto</option>
                    <option value="CANCELADO">Cancelado</option>
                </select>
            </div> 
        </div>

        <div class="row mb-3">
            <div class="col-md-1 col-5 mb-3">
                <label>Qtd.</label>
                <input type="text" id="quantidade"  class="form-control">
            </div>
            <div class="col-md-3 mb-3">
                <label>Item do Cardápio</label>
                <select id="itemCardapio" class="form-select">
                    <option value="">Selecione...</option>
                    @foreach($itensCardapio as $item)
                        <option value="{{ $item->id_cardapio }}" >{{ $item->produto }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-success" onclick="adicionarItensDoPedido()">Adicionar</button>
            </div>
        </div>

        <div class="row mb-5">
            <div id="listaItensPedido" class="col-12">

            </div>
        </div>
        
        <div class="mb-3">
            <button class="btn btn-primary">Salvar</button>
            <a href="{{url('pedidos')}}" class="btn btn-danger">Voltar</a>
        </div>
    </form>


    <script>
        var lista = document.getElementById('listaItensPedido');
        


        function adicionarItensDoPedido() {

            var quantidade = document.getElementById('quantidade').value;
            var itemCardapio = document.getElementById('itemCardapio');
            var valueItem     = itemCardapio.value;
            var descricaoItem = itemCardapio.options[itemCardapio.selectedIndex].text;

            lista.innerHTML = `
                                <div>${lista.innerHTML} ${quantidade}  - ${descricaoItem} </div>

                                <input type="hidden" name="quantidade[]" value="${quantidade}" />
                                <input type="hidden" name="itemPedido[]" value="${valueItem}" />
                            `;
        }
    </script>

@endsection