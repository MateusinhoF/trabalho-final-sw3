<x-template titulodapagina="Vendedor" acessode="Vendedor">

    <div class="d-flex justify-content-around">
        <x-link href="{{route('vendedor.create')}}" texto="Cadastrar Produto"/>
        <x-link href="{{route('logout')}}" texto="Sair"/>
    </div>

    <div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Quantidade</th>
                    <th>Quantidade vendido</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                    <tr>
                        <td><img src="{{asset('/img/produtos/'.$produto->hash_nome_arquivo)}}" alt=""></td>
                        <td>{{$produto->nome}}</td>
                        <td>{{$produto->descricao}}</td>
                        <td>{{str_replace('.',',',$produto->valor_unitario)}}</td>
                        <td>{{$produto->quantidade}}</td>
                        <td>{{$produto->quantidade_vendido}}</td>
                        <td>
                            <x-link href="{{route('vendedor.edit', ['id'=>$produto->id])}}" texto="Editar"/>
                            <x-link href="{{route('vendedor.destroy', ['id'=>$produto->id])}}" texto="Excluir"/>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-errors/>
</x-template>