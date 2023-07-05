<x-template titulodapagina="Pedidos realizados" acessode="Comprador">

    <a href="{{route('comprador.index')}}">Voltar</a>
    <a href="{{route('logout')}}">Sair</a>
  
    <div>
        <table>
            <thead>
                <tr>
                    <th>Codigo do Pedido</th>
                    <th>Valor Total</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{$pedido->codigo}}</td>
                        <td>{{str_replace('.',',',$pedido->valor_total)}}</td>
                        <td>
                            <a href="{{route('comprador.detalhespedido', ['id_pedido'=>$pedido->id])}}">Ver itens</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-errors/>
</x-template>