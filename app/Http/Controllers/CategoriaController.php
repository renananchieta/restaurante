<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        return view('categoria.categorias', compact('categorias'));
    }

    public function create()
    {
        return view('categoria.create');
    }

    public function store(Request $request)
    {
        try{
            $categoria = new Categoria();
            $categoria->nome = $request->nome;
            $categoria->save();

            return redirect('categorias')->with('mensagem', 'Categoria salva com SUCESSO.');
        } catch(Exception $ex){
            return redirect('categorias')->with('error', 'ERRO ao salvar Categoria'.$ex->getMessage());
        }
    }

    public function show ($id)
    {
        $categoria = Categoria::find($id);

        return view('categoria.edit', compact('categoria'));
    }

    public function update(Request $request)
    {
        try{
            $categoria = Categoria::find($request->id);
            $categoria->nome=$request->nome;
            $categoria->save();

            return redirect('categorias')->with('mensagem', 'Categoria Alterada com sucesso');
        } catch(Exception $ex){
            return redirect('categorias')->with('error', 'Erro ao alterar Categorgia'.$ex->getMessage());
        }
    }

    public function delete(Request $request)
    {
        try{
            $categoria = Categoria::find($request->id);
            $categoria->delete();

            return redirect('categorias')->with('mensagem', 'Categoria REMOVIDA com sucesso');
        } catch(Exception $ex){
            redirect('categorias')->with('error', 'ERRO ao remover categoria'.$ex->getMessage());
        }
    }
}
