<x-template titulodapagina="Detalhes do Pedido" acessode="Comprador">

    <a href="{{route('comprador.pedidos')}}">Voltar</a>
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
                </tr>               
                @endforeach
            </tbody>
        </table>
    </div>

    Valor Total
    <p>R${{str_replace('.',',',$valor_total)}}</p>

    <x-errors/>
</x-template>