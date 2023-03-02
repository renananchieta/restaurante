<?php

namespace App\Http\Controllers;

use App\Models\Cardapio;
use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CardapioController extends Controller
{
    public function index()
    {
        $cardapios = Cardapio::all();
        return view('cardapio.cardapio', compact('cardapios'));
    }

    public function create()
    {
        $produtos = Produto::all();
        return view('cardapio.create', compact('produtos'));
    }

    public function store(Request $request)
    {
        try{
            $cardapio = new Cardapio();
            $cardapio->fk_produto = $request->produto;
            $cardapio->descricao = $request->descricao;
            $cardapio->valor = $request->valor; 
            $cardapio->save();

            return redirect('cardapio')->with('mensagem', 'Cardápio salvo com sucesso.');
        }catch(Exception $ex){
            return redirect('cardapio')->with('error', 'Erro ao salvar Cardápio.'.$ex->getMessage());
        }
    }

    public function show($id)
    {
        $produtos = Produto::all();
        $cardapio = Cardapio::find($id);

        return view('cardapio.edit', compact('produtos', 'cardapio'));
    }

    public function update(Request $request)
    {
        try{
            $cardapio = Cardapio::find($request->id);
            $cardapio->valor = $request->valor;
            $cardapio->descricao = $request->descricao;
            $cardapio->fk_produto = $request->produto;
            $cardapio->save();

            return redirect('cardapio')->with('mensagem', 'Cardápio alterado com sucesso');
        }catch(Exception $ex){
            return redirect('cardapio')->with('error', 'Erro ao alterar cardápio'.$ex->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try{
            $cardapio = Cardapio::find($request->id);
            $cardapio->delete();

            return redirect('cardapio')->with('mensagem', 'Cardápio removido com sucesso.');
    } catch(Exception $ex){
        return redirect('cardapio')->with('error', 'Erro ao remover cardápio'.$ex->getMessage());    
    }
    }
}
