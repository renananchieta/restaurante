<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
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
                                ->first(['saldo']);

            $saldoClienteOrigem = $clienteOrigem->saldo;

            // CLIENTE QUE RECEBE O VALOR INSERIDO:
            $clienteDestino = DB::table("cliente as cl")
                                ->where("cl.identificacao","=", $request->identificacaoDestino)
                                ->first(['saldo']);
            
            $saldoClienteDestino = $clienteDestino->saldo;

            //VALOR A SER TRANSFERIDO:
            $valorDaTransferencia = $request->valorDaTransferencia;

            if ($saldoClienteOrigem < $valorDaTransferencia){
                throw new Exception(' Saldo Insuficiente.');
            } else {

                $clienteOrigem = DB::table("cliente as cl")
                                    ->where("cl.identificacao","=", $request->identificacaoOrigem)
                                    ->decrement('saldo', $valorDaTransferencia);

                $clienteDestino = DB::table("cliente as cl")
                                     ->where("cl.identificacao", "=", $request->identificacaoDestino)
                                     ->increment('saldo',$valorDaTransferencia);
            }

            return redirect('clientes')->with('mensagem','Transferência concluída com sucesso.');
        } catch(Exception $ex){
            return redirect('transferircredito')->with('error', 'Erro ao realizar a transferência.'. $ex->getMessage());
        }

        

    }

}
