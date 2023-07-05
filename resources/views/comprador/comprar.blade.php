<x-template titulodapagina="Produto" acessode="Comprador">

    <a href="{{route('comprador.index')}}">Voltar</a>
    <a href="{{route('logout')}}">Sair</a>
    
    <form action="{{route('comprador.adicionaraocarrinho',['id_produto'=>$produto->id])}}" method="post">
    
        @csrf
        Imagem atual
        <img src="{{asset('/img/produtos/'.$produto->hash_nome_arquivo)}}" alt="">
        Nome
        <p>{{$produto->nome}}</p>
        Descrição
        <p>{{$produto->descricao}}</p>
        Quantidade disponivel
        <p>{{$produto->quantidade - $produto->quantidade_vendido}}</p>
        <p>R${{str_replace('.',',',$produto->valor_unitario)}}</p>
        
        Quantidade
        <input type="text" name="quantidade" id="quantidade">

        <input type="submit" value="Adicionar ao carrinho">
    </form>

    <x-errors/>
</x-template>