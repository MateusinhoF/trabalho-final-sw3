<x-template titulodapagina="Comprador" acessode="Comprador">

    <div class="d-flex justify-content-around">
        <x-link href="{{route('comprador.pedidos')}}" texto="Pedidos"/>
        <x-link href="{{route('comprador.carrinho')}}" texto="Carrinho"/>
        <x-link href="{{route('logout')}}" texto="Sair"/>
    </div>

    <div>
        <table class="table table-striped table-hover">
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
                        <td><img src="{{asset('/img/produtos/'.$produto->hash_nome_arquivo)}}" alt="" class="img-thumbnail"></td>
                        <td>{{$produto->nome}}</td>
                        <td>{{str_replace('.',',',$produto->valor_unitario)}}</td>
                        <td>
                            <x-link href="{{route('comprador.comprar',['id_produto'=>$produto->id])}}" texto="Comprar"/>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-errors/>
</x-template>