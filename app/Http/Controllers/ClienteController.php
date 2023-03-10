<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Movimentacao;
use App\Models\PedidoItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();

        return view('cliente.clientes', compact('clientes'));
    }

    public function create()
    {
        return view('cliente.create');
    }

    public function store(Request $request)
    {
        try{
            $cliente = new Cliente();
            $cliente->nome = $request->nome;
            $cliente->telefone = $request->telefone;
            $cliente->identificacao = $request->identificacao;
            $cliente->saldo = $request->saldo;
            $cliente->save();

            //MOVIMENTAÇÃO DE ENTRADA: CADASTRO DE USUÁRIO COM UM SALDO INICIAL
            $extrato = new Movimentacao();
            $extrato->fk_cliente = $cliente->id;
            $extrato->valor = $cliente->saldo;
            $extrato->fk_tipo_movimentacao = 1;
            $extrato->data = date('Y-m-d H:i:s');
            $extrato->observacao = 'Referente a entrada de crédito no cadastro.';
            $extrato->save();

            return redirect('clientes')->with('mensagem', 'Cliente cadastrado com sucesso!');
        }catch(Exception $ex){
            return redirect('clientes')->with('error','Erro ao cadastrar cliente'.$ex->getMessage());
        }
    }

    public function show($id)
    {
        $cliente = Cliente::find($id);

        return view('cliente.edit', compact('cliente'));
    }

    public function update(Request $request)
    {
        try{
            $cliente = Cliente::find($request->id);
            $cliente->nome = $request->nome;
            $cliente->telefone = $request->telefone;
            $cliente->identificacao = $request->identificacao;
            $cliente->saldo = $request->saldo;
            $cliente->save();

            return redirect('clientes')->with('mensagem', 'Cliente alterado com sucesso.');
        } catch(Exception $ex){
            return redirect('clientes')->with('error', 'Erro ao alterar cliente'.$ex->getMessage());
        }
    }

    public function visualizar()
    {
        $clientes = Cliente::all();

        return view('cliente.transferirCredito', compact('clientes'));
    }

    public function concluirTransferencia(Request $request)
    {
        try{
            // CLIENTE QUE TRANSFERE O VALOR INSERIDO: 
            $clienteOrigem = DB::table("cliente as cl")
                                ->where("cl.identificacao","=", $request->identificacaoOrigem)
                                ->first(['id', 'nome', 'saldo']);

            $saldoClienteOrigem = $clienteOrigem->saldo;

            //VALOR A SER TRANSFERIDO:
            $valorDaTransferencia = $request->valorDaTransferencia;

            if ($saldoClienteOrigem < $valorDaTransferencia){
                throw new Exception(' Saldo Insuficiente.');
            } else {

                DB::table("cliente as cl")
                                    ->where("cl.identificacao","=", $request->identificacaoOrigem)
                                    ->decrement('saldo', $valorDaTransferencia);

                DB::table("cliente as cl")
                    ->where("cl.identificacao", "=", $request->identificacaoDestino)
                    ->increment('saldo',$valorDaTransferencia);


                $clienteDestino = DB::table("cliente as cl")
                                    ->where("cl.identificacao", "=", $request->identificacaoDestino)
                                    ->first();




                //MOVIMENTAÇÃO CLIENTE ORIGEM
                $extrato = new Movimentacao();
                $extrato->fk_cliente = $clienteOrigem->id;
                $extrato->valor = $valorDaTransferencia;
                $extrato->fk_tipo_movimentacao = 2;
                $extrato->data = date('Y-m-d H:i:s');
                $extrato->observacao = 'Transferência de crédito para '.$clienteDestino->nome;
                $extrato->save();


                //MOVIMENTAÇÃO CLIENTE DESTINO
                $extrato = new Movimentacao();
                $extrato->fk_cliente = $clienteDestino->id;
                $extrato->valor = $valorDaTransferencia;
                $extrato->fk_tipo_movimentacao = 1;
                $extrato->data = date('Y-m-d H:i:s');
                $extrato->observacao = 'Recebimento via transferência de crédito por '.$clienteOrigem->nome;
                $extrato->save();
            }

            return redirect('clientes')->with('mensagem','Transferência concluída com sucesso.');
        } catch(Exception $ex){
            return redirect('transferircredito')->with('error', 'Erro ao realizar a transferência.'. $ex->getMessage());
        }
    }

    public function extrato($id)
    {
        $cliente = Cliente::find($id);

        $extrato = Movimentacao::where('fk_cliente', $id)->get();
        

        return view('cliente.extrato', compact('extrato','cliente'));
    }    

}
