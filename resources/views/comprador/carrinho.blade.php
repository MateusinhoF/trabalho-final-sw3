<x-template titulodapagina="Carrinho" acessode="Comprador">

    <div class="d-flex justify-content-around">
        <x-link href="{{route('comprador.index')}}" texto="Voltar"/>
        <x-link href="{{route('logout')}}" texto="Sair"/>
    </div>

    <div>
        <table class="table table-striped table-hover">
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
                        <x-link href="{{route('comprador.retirarproduto', ['id_pedido'=>$produto->id])}}" texto="Excluir"/>
                    </td>
                </tr>               
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        <p>Valor Total: </p>
        <p>R${{str_replace('.',',',$valor_total)}}</p>
    </div>

    <div class="d-flex justify-content-center">
        <x-link href="{{route('comprador.finalizarcompra', ['id_codigo_do_pedido' => $produto->codigo_do_pedido_id])}}" texto="Finalizar compra"/>
    </div>

    <x-errors/>
</x-template>