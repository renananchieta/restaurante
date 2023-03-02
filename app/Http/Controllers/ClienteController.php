<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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
            $cliente->save();

            return redirect('clientes')->with('mensagem', 'Cliente alterado com sucesso.');
        } catch(Exception $ex){
            return redirect('clientes')->with('error', 'Erro ao alterar cliente'.$ex->getMessage());
        }
    }

}
