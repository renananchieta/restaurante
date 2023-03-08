<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\PedidoItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::all();

        return view('pedido.pedidos', compact('pedidos'));
    }

    public function create()
    {
        $clientes = Cliente::all();

        $itensCardapio = DB::table("cardapio as c")
                            ->join("produto as p", "p.id", "=", "c.fk_produto")
                            ->select([
                                'c.id as id_cardapio',
                                DB::raw("UPPER(p.nome) as produto"),
                                'c.valor'
                            ])
                            ->orderBy('p.nome')
                            ->get();

        return view('pedido.create', compact('itensCardapio', 'clientes'));
    }

    public function store(Request $request)
    {
        try {
            //$saldo = Cliente::where('identificacao', $request->identificacao)->first()->saldo;
            //GUARDA O SALDO DO CLIENTE
            $cliente = DB::table("cliente as cl")
                        ->where("cl.identificacao", "=", $request->identificacao)
                        ->first(['saldo']);

            //------------------------------------------------------------------------------------------------------------------------                        
            //Renato: CALCULA O VALOR DO PEDIDO ANTES DE SALVAR.
            $valorTotalPedido = 0;

            foreach ($request->itemPedido as $i => $id_cardapio) {
                $cardapio = Cardapio::find($id_cardapio);
                $valorTotalPedido = $valorTotalPedido + ($request->quantidade[$i] * $cardapio->valor);
            }

            //------------------------------------------------------------------------------------------------------------------------            

            $saldoCliente = $cliente->saldo;
            
            if ($saldoCliente < $valorTotalPedido) {                                         // SALDO DO CLIENTE MENOR QUE O VALOR DO PEDIDO: NÃO SALVA O PEDIDO.
                throw new Exception(' Saldo insuficiente.');                            
            } else if ($saldoCliente >= $valorTotalPedido) {                                 // SALDO DO CLIENTE MAIOR OU IGUAL AO VALOR DO PEDIDO: SALVA O PEDIDO

                $cliente = DB::table("cliente as cl")                                        // SUBTRAI DO SALDO DO CLIENTE O VALOR TOTAL DO PEDIDO. SALVA O NOVO SALDO.
                                ->where("cl.identificacao","=",$request->identificacao)
                                ->decrement('saldo',$valorTotalPedido);

                $pedido = new Pedido();
                $pedido->data = date('Y-m-d');
                $pedido->mesa = $request->mesa;
                $pedido->status = 'PENDENTE';
                $pedido->identificacao_cliente = $request->identificacao;
                $pedido->created_at = date('Y-m-d H:i:s');
                $pedido->save();

                foreach ($request->itemPedido as $i => $id_cardapio) {

                    $cardapio = Cardapio::find($id_cardapio);

                    $pedidoItem = new PedidoItem();
                    $pedidoItem->fk_pedido = $pedido->id;
                    $pedidoItem->fk_cardapio = $id_cardapio;
                    $pedidoItem->quantidade = $request->quantidade[$i];
                    $pedidoItem->valor_unitario = $cardapio->valor;
                    $pedidoItem->valor_total = $request->quantidade[$i] * $cardapio->valor;
                    $pedidoItem->save();
                }

            }



            return redirect('pedidos')->with('mensagem', 'Pedido salvo com sucesso.');
        } catch (Exception $ex) {
            return redirect('pedidos')->with('error', 'Erro ao salvar pedido.' . $ex->getMessage());
        }
    }

    public function show($id)
    {
        $itensCardapio = Cardapio::all();
        $pedido = Pedido::find($id);

        return view('pedido.edit', compact('itensCardapio', 'pedido'));
    }



    public function cancelar(Request $request)
    {
        try {
            $pedido = Pedido::find($request->id);
            $pedido->status = "CANCELADO";
            $pedido->save();
            return redirect('pedidos')->with('mensagem', 'Pedido cancelado com sucesso.');
        } catch (Exception $ex) {
            return redirect('pedidos')->with('error', 'Erro ao cancelar pedido' . $ex->getMessage());
        }
    }


    public function visualizar($id)
    {
        $pedido = Pedido::find($id);

        //dd($pedido->status);

        $itensDoPedido = DB::table("pedido_itens as pi")
            ->join("pedido as pe", "pe.id", "=", "pi.fk_pedido")
            ->join("cardapio as c", "c.id", "=", "pi.fk_cardapio")
            ->join("produto as p", "p.id", "=", "c.fk_produto")
            ->where("pe.id", "=", $id)
            ->select([
                'pe.id as id_pedido_itens',
                DB::raw("UPPER(p.nome) as produto"),
                'pi.quantidade as qtd',
                'pi.id as id_pedido',
            ])
            ->orderBy('p.nome')
            ->get();

        return view('pedido.view', compact('itensDoPedido', 'pedido'));
    }

    public function statusPedido(Request $request)
    {
        $pedido = Pedido::find($request->id);
        $pedido->status = "PRONTO";
        $pedido->save();

        return redirect('pedidos')->with('mensagem', 'Pedido PRONTO');
    }

    public function encerrarConta()
    {
        $cliente = Cliente::all();

        return view('pedido.encerrarconta', compact('cliente'));
    }

    public function encerrarContaDetalhes($identificacao)
    {

        $cliente = Cliente::where('identificacao', $identificacao)->first();

        $itensDoPedido = DB::table("pedido_itens as pi")
            ->join("pedido as pe", "pe.id", "=", "pi.fk_pedido")
            ->join("cardapio as c", "c.id", "=", "pi.fk_cardapio")
            ->join("produto as p", "p.id", "=", "c.fk_produto")
            ->join("cliente as cl", "cl.identificacao", "=", "pe.identificacao_cliente")
            ->where("pe.identificacao_cliente", "=", $identificacao)
            ->select([
                'pe.id as id_pedido',
                'pe.identificacao_cliente as identificacao_pedido',
                DB::raw("UPPER(p.nome) as produto"),
                'pi.quantidade as quantidade',
                'c.valor as valor',
                'pe.created_at as data',
                'pi.valor_total as valorTotal'
            ])
            ->orderBy('p.nome')
            ->get();

            $totalPagar = 0;

            foreach($itensDoPedido as $valorPagar){
                $totalPagar = $totalPagar + $valorPagar->valorTotal;
            }

        return view('pedido.encerrarcontaitens', compact('itensDoPedido', 'cliente', 'totalPagar'));
    }
}
