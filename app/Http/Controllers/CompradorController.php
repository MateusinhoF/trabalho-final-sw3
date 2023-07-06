<?php

namespace App\Http\Controllers;

use App\Models\CodigoDoPedido;
use App\Models\Compra;
use App\Models\Pedido;
use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class CompradorController extends Controller
{
    
    public function index()
    {
        $produtos = Produto::all()->where('produto_disponivel','=',true);
        return view('comprador/index',['produtos'=>$produtos]);
    }

    public function comprar(string $id_produto){
        
        $produto = Produto::all()->where('id','=',$id_produto)->first();
        
        if ($produto){
            return view('comprador/comprar',['produto'=>$produto]);
        }else{
            return redirect(route('comprador/index'))->withErrors(['errors'=>'produto nao encontrado']);
        }
        

    }

    public function adicionaraocarrinho(string $id_produto, Request $request){
        
        $request->validate([
            'quantidade'=>'required|integer'
        ]);

        $quantidade = $request->quantidade;

        $produto = Produto::all()->where('id','=',$id_produto)->first();
        $user = Auth::user();

        if ($produto){
            
            if($quantidade > ($produto->quantidade - $produto->quantidade_vendido)){
                return redirect(route('comprador.comprar',['id_produto'=>$id_produto]))->withErrors(['errors'=>'quantidade indisponivel']);
            }
            
            $pedido = Pedido::where('user_id','=',$user->id)->orderBy('created_at', 'desc')->first();

            if(!is_null($pedido)){
                
                $codigo_do_pedido = CodigoDoPedido::all()->where('id','=',$pedido->codigo_do_pedido_id)->where('pedido_realizado','=',false)->first();
                
                if(is_null($codigo_do_pedido)){
                    $codigo = [
                        'codigo'=>md5(now())
                    ];
                    $codigo_do_pedido = CodigoDoPedido::create($codigo);
                }
            }
            else{
                $codigo = [
                    'codigo'=>md5(now())
                ];
                $codigo_do_pedido = CodigoDoPedido::create($codigo);
            }
            $pedido = [
                'user_id'=>$user->id,
                'produto_id'=>$id_produto,
                'codigo_do_pedido_id'=>$codigo_do_pedido->id,
                'quantidade'=>$quantidade,
                'valor_unitario'=>$produto->valor_unitario,
                'valor_total'=>$produto->valor_unitario*$quantidade,

            ];

            try{
                
                Pedido::create($pedido);
            }catch(Exception $e){
                return redirect(route('comprador.index'))->withErrors(['errors'=>'não foi possivel realizar a adição ao carrinho '.$e->getMessage()]);    
            }
            return redirect(route('comprador.carrinho'));
        }else{
            return redirect(route('comprador.index'))->withErrors(['errors'=>'produto não encontrado']);
        }
    }

    public function carrinho(){
        
        $user = Auth::user();
        $produtos = DB::table('pedido')->join('codigo_do_pedido','pedido.codigo_do_pedido_id','=','codigo_do_pedido.id')
                                    ->join('produto','pedido.produto_id','=','produto.id')
                                    ->where('codigo_do_pedido.pedido_realizado','=',false)
                                    ->where('pedido.user_id','=',$user->id)
                                    ->select('pedido.*', 'produto.nome','produto.hash_nome_arquivo','produto.descricao')
                                    ->get();
        
        if ($produtos->count() > 0){
            $valorTotal = 0;
            foreach ($produtos as $produto){
                $valorTotal += $produto->valor_total;
            }
            return view('comprador/carrinho', ['produtos'=>$produtos, 'valor_total'=>$valorTotal]);
        }
        return redirect(route('comprador.index'));
    }

    public function finalizarcompra(string $id_codigo_do_pedido){
        
        try{
            $user = Auth::user();

            $pedidos = Pedido::all()->where('codigo_do_pedido_id','=',$id_codigo_do_pedido)->where('user_id','=',$user->id);

            $codigoDoPedido = CodigoDoPedido::where('id','=',$id_codigo_do_pedido)->first();
            
            $valorTotal = 0;
            foreach ($pedidos as $pedido){
                $valorTotal = $valorTotal + $pedido->valor_total;

                $produto = Produto::where('id','=',$pedido->produto_id)->first();
                
                $quantidadeVendido = $pedido->quantidade + $produto->quantidade_vendido;
                $produto->quantidade_vendido = $quantidadeVendido;
                if($quantidadeVendido >= $produto->quantidade){
                    $produto->update([
                        'quantidade_vendido'=>$quantidadeVendido,
                        'produto_disponivel'=>false
                    ]);
                }else{
                    $produto->update([
                        'quantidade_vendido'=>$quantidadeVendido
                    ]);
                }
            }

            $codigoDoPedido->pedido_realizado = true;
            $codigoDoPedido->save();

            $compra = [
                'user_id'=>$user->id,
                'codigo_do_pedido_id'=>$codigoDoPedido->id,
                'valor_total'=>$valorTotal
            ];
            
            Compra::create($compra);

            return redirect(route('comprador.pedidos'));

        }
        catch(Exception $e){
            return redirect(route('comprador.index'))->withErrors(['errors'=>'erro ao finalizar o pedido '.$e->getMessage()]);
        }

    }

    public function retirarproduto(string $id_pedido){
        try{
            $pedido = Pedido::find($id_pedido);
            
            if($pedido){
                $pedido->delete();
            }

        }catch(Exception $e){
            return redirect(route('comprador.carrinho',['errors'=>'Erro na exclusão: '.$e->getMessage()]));
        }

        return redirect(route('comprador.carrinho'));
    }

    public function pedidos()
    {
        
        $user = Auth::user();
        $pedidos = DB::table('compra')->join('codigo_do_pedido','compra.codigo_do_pedido_id','=','codigo_do_pedido.id')
                                      ->where('compra.user_id','=',$user->id)
                                      ->select('compra.*','codigo_do_pedido.codigo')
                                      ->get();
        
        return view('comprador/pedidos',['pedidos'=>$pedidos]);
    }

    public function detalhespedido(string $id_pedido){
        

        $compra = Compra::where('id','=',$id_pedido)->first();

        $produtos = DB::table('pedido')->join('produto','pedido.produto_id','=','produto.id')
                                     ->where('pedido.codigo_do_pedido_id','=',$compra->codigo_do_pedido_id)
                                     ->select('pedido.*','produto.nome','produto.descricao','produto.hash_nome_arquivo')
                                     ->get();
        
        return view('comprador.detalhes',['produtos'=>$produtos, 'valor_total'=>$compra->valor_total]);
    }

}
