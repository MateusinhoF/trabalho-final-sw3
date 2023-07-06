<x-template titulodapagina="Pedidos realizados" acessode="Comprador">

    <div class="d-flex justify-content-around">
        <x-link href="{{route('comprador.index')}}" texto="Voltar"/>
        <x-link href="{{route('logout')}}" texto="Sair"/>
    </div>
  
    <div>
        <table class="table table-striped table-hover">
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
                            <x-link href="{{route('comprador.detalhespedido', ['id_pedido'=>$pedido->id])}}" texto="Ver itens"/>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-errors/>
</x-template>