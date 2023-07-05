<x-template titulodapagina="Vendedor" acessode="Vendedor">

    <a href="{{route('vendedor.create')}}">Cadastrar Produto</a>
    <a href="{{route('logout')}}">Sair</a>

    <div>
        <table>
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
                        <td>{{$produto->hash_nome_arquivo}}</td>
                        <td>{{$produto->nome}}</td>
                        <td>{{$produto->descricao}}</td>
                        <td>{{str_replace('.',',',$produto->valor_unitario)}}</td>
                        <td>{{$produto->quantidade}}</td>
                        <td>{{$produto->quantidade_vendido}}</td>
                        <td>
                            <a href="{{route('vendedor.edit', ['id'=>$produto->id])}}">Editar</a>
                            <a href="{{route('vendedor.destroy', ['id'=>$produto->id])}}">Excluir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-errors/>
</x-template>