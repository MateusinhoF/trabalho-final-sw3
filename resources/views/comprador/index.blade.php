<x-template titulodapagina="Comprador" acessode="Comprador">

    <a href="{{route('comprador.pedidos')}}">Pedidos</a>
    <a href="{{route('comprador.carrinho')}}">Carrinho</a>
    <a href="{{route('logout')}}">Sair</a>

    <div>
        <table>
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                    <tr>
                        <td>{{$produto->hash_nome_arquivo}}</td>
                        <td>{{$produto->nome}}</td>
                        <td>{{str_replace('.',',',$produto->valor_unitario)}}</td>
                        <td>
                            <a href="{{route('comprador.comprar',['id_produto'=>$produto->id])}}">Comprar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-errors/>
</x-template>