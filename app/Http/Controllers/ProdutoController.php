<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('produto.produtos', compact('produtos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('produto.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        try{
            $produto = new Produto();
            $produto->nome = $request->nome;
            $produto->fk_categoria = $request->categoria;
            $produto->save();

            return redirect('produtos')->with('mensagem', 'Produto salvo com SUCESSO');
        } catch(Exception $ex){
            return redirect('produtos')->with('error', 'ERRO ao salvar produto'.$ex->getMessage());
        }
    }

    public function show($id)
    {
        $categorias = Categoria::all();
        $produto = Produto::find($id);
        
        return view('produto.edit', compact('categorias', 'produto'));
    }

    public function update(Request $request)
    {
        try{
            $produto = Produto::find($request->id);
            $produto->nome = $request->nome;
            $produto->fk_categoria = $request->categoria;
            $produto->save();

            return redirect('produtos')->with('mensagem', 'Produto alterado com sucesso');
        } catch (Exception $ex){
            return redirect('produtos')->with('error', 'Erro ao alterar produto'.$ex->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try{
            $produto = Produto::find($request->id);
            $produto->delete();

            return redirect('produtos')->with('mensagem', 'Produto removido com sucesso.');
        }catch(Exception $ex){
            return redirect('produtos')->with('error', 'Erro ao remover produto'.$ex->getMessage());
        }
    }
}