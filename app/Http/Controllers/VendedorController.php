<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Exception;
use Hamcrest\Type\IsNumeric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class VendedorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $produtos = Produto::all()->where('user_id','=',$user->id);
        return view('vendedor/index',['produtos'=>$produtos]);
    }

    public function create()
    {
        
        return view('vendedor/cadastrar');
    }

    public function store(Request $request)
    {
        

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid() && isset($request->imagem)){

            $request->validate([
                'nome'=>'required',
                'descricao'=>'required',
                'valor_unitario'=>'required',
                'quantidade'=>'required|integer'
            ]);

            try{
                $valor_unitario = (float) str_replace(',','.',$request->valor_unitario);
            }catch(Exception $e){
                return redirect(route('vendedor.create'))->withErrors(['errors'=>'valor unitario invalido '.$e->getMessage()]);
            }

            $requestImagem = $request->imagem;

            $extensao = $requestImagem->extension();

            if ($extensao != 'jpg' && $extensao != 'jpeg' && $extensao != 'png'){
                return redirect(route('vendedor.create'))->withErrors(['errors'=>'insira uma imagem valida nos formaos JPG, JPEG ou PNG']);
            }

            $hash_nome_arquivo = md5(now()).'.'.$extensao;

            $produto = [
                'nome'=>$request->nome,
                'descricao'=>$request->descricao,
                'valor_unitario'=>$valor_unitario,
                'quantidade'=>$request->quantidade,
                'hash_nome_arquivo'=>$hash_nome_arquivo,
                'user_id'=>Auth::user()->id,
                'quantidade_vendido'=>0,
                'produto_disponivel'=>true
            ];

            try{
                Produto::create($produto);
                $requestImagem->move(public_path('/img/produtos'), $hash_nome_arquivo);
            }catch(Exception $e){
                return redirect(route('vendedor.create'))->withErrors(['errors'=>'Erro ao cadastrar produto '.$e->getMessage()]);
            }
            return redirect(route('vendedor.index'));
        }else{
            return redirect(route('vendedor.create'))->withErrors(['errors'=>'insira uma imagem']);
        }
    }

    public function edit(string $id)
    {
        try{
            $produto = Produto::find($id);
        }catch(Exception $e){
            return redirect(route('vendedor.index',['errors'=>'Erro na edição: '.$e->getMessage()]));
        }

        return view('vendedor/editar',['produto'=>$produto]);
    }

    public function update(Request $request, string $id)
    {
        
        $produto = Produto::find($id);

        if(!$produto){
            return redirect(route('vendedor.index',['errors'=>'Produto nao encontrado']));
        }

        $request->validate([
            'nome'=>'required',
            'descricao'=>'required',
            'valor_unitario'=>'required',
            'quantidade'=>'required|integer'
        ]);

        $valor_unitario = (float) str_replace(',','.',$request->valor_unitario);
        
        $novoProduto = $produto;
        $houvealteracao = false;
        
        if($produto->nome != $request->nome){
            $novoProduto->nome = $request->nome;
            $houvealteracao = true;
        }

        if($produto->descricao != $request->descricao){
            $novoProduto->descricao = $request->descricao;
            $houvealteracao = true;
        }

        if($produto->valor_unitario != $valor_unitario){
            $novoProduto->valor_unitario = $valor_unitario;
            $houvealteracao = true;
        }

        if($produto->quantidade != $request->quantidade){
            $novoProduto->quantidade = $request->quantidade;
            $houvealteracao = true;
            
        }

        if($produto->quantidade_vendido != $request->quantidade_vendido){
            $novoProduto->quantidade_vendido = $request->quantidade_vendido;
            $houvealteracao = true;

        }

        if($request->hasFile('imagem') && $request->file('imagem')->isValid() && isset($request->imagem)){
            $houvealteracao = true;
            
            $requestImagem = $request->imagem;

            $extensao = $requestImagem->extension();

            if ($extensao != 'jpg' && $extensao != 'jpeg' && $extensao != 'png'){
                return redirect(route('vendedor.edit'))->withErrors(['errors'=>'insira uma imagem valida nos formaos JPG, JPEG ou PNG']);
            }

            try{
                $hash_nome_arquivo = md5(now()).'.'.$extensao;
                $requestImagem->move(public_path('/img/produtos'), $hash_nome_arquivo);
                $novoProduto->hash_nome_arquivo = $hash_nome_arquivo;
            }catch(Exception $e){
                return redirect(route('vendedor.edit'))->withErrors(['errors'=>'Erro salvar a imagem '.$e->getMessage()]);
            }
        }

        if($houvealteracao){
            
            if ($produto->quantidade <= $novoProduto->quantidade_vendido){
                $novoProduto->produto_disponivel = false;
            }
            if ($produto->quantidade >= $novoProduto->quantidade_vendido){
                $novoProduto->produto_disponivel = true;
            }
            try{
                $produto->update([
                    'nome'=>$novoProduto->nome,
                    'descricao'=>$novoProduto->descricao,
                    'valor_unitario'=>$novoProduto->valor_unitario,
                    'quantidade'=>$novoProduto->quantidade,
                    'user_id'=>$novoProduto->user_id,
                    'hash_nome_arquivo'=>$novoProduto->hash_nome_arquivo,
                    'quantidade_vendido'=>$novoProduto->quantidade_vendido,
                    'produto_disponivel'=>$novoProduto->produto_disponivel
                ]);
            }catch(Exception $e){
                return redirect(route('vendedor.edit'))->withErrors(['errors'=>'Erro ao alterar produto '.$e->getMessage()]);
            }
        }

        return redirect(route('vendedor.index'));
        
    }
    
    public function destroy(string $id)
    {
        try{
            $produto = Produto::find($id);

            if($produto){
                $produto->delete();
            }
        }catch(Exception $e){
            return redirect(route('vendedor.index',['errors'=>'Erro na exclusão: '.$e->getMessage()]));
        }

        return redirect(route('vendedor.index'));
    }
}
