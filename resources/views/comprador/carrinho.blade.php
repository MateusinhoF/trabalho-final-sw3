<x-template titulodapagina="Carrinho" acessode="Comprador">

    <a href="{{route('comprador.index')}}">Voltar</a>
    <a href="{{route('logout')}}">Sair</a>
    
    <div>
        <table>
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Quantidade pedido</th>
                    <th>Preço unitario</th>
                    <th>Valor total do item</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                <tr>
                    <td>
                        <img src="{{asset('/img/produtos/'.$produto->hash_nome_arquivo)}}" alt="">
                    </td>
                    <td>
                        <p>{{$produto->nome}}</p>
                    </td>
                    <td>
                        <p>{{$produto->descricao}}</p>
                    </td>
                    <td>
                        <p>{{$produto->quantidade}}</p>
                    </td>
                    <td>
                        <p>R${{str_replace('.',',',$produto->valor_unitario)}}</p>
                    </td>
                    <td>
                        <p>R${{str_replace('.',',',$produto->valor_total)}}</p>
                    </td>
                    <td>
                        <a href="{{route('comprador.retirarproduto', ['id_pedido'=>$produto->id])}}">Excluir</a>
                    </td>
                </tr>               
                @endforeach
            </tbody>
        </table>
    </div>

    Valor Total
    <p>R${{str_replace('.',',',$valor_total)}}</p>


    <a href="{{route('comprador.finalizarcompra', ['id_codigo_do_pedido' => $produto->codigo_do_pedido_id])}}">Finalizar compra</a>
    <x-errors/>
</x-template>