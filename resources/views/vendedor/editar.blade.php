<x-template titulodapagina="Editar Produto" acessode="Vendedor">

    <a href="{{route('vendedor.index')}}">Voltar</a>
    <a href="{{route('logout')}}">Sair</a>

    <form action="{{route('vendedor.update',['id'=>$produto->id])}}" method="post" enctype="multipart/form-data">
    
        @csrf
        Nome
        <input type="text" name="nome" id="nome" value="{{$produto->nome}}">
        Descricao
        <input type="text" name="descricao" id="descricao" value="{{$produto->descricao}}">
        Valor Unitario
        <input type="text" name="valor_unitario" id="valor_unitario" value="{{str_replace('.',',',$produto->valor_unitario)}}">
        Quantidade
        <input type="text" name="quantidade" id="quantidade" value="{{$produto->quantidade}}">
        Quantidade vendido
        <input type="text" name="quantidade_vendido" id="quantidade_vendido" value="{{$produto->quantidade_vendido}}">
        Imagem atual
        <img src="{{asset('/img/produtos/'.$produto->hash_nome_arquivo)}}" alt="">
        Imagem
        <input type="file" name="imagem" id="imagem">

        <input type="submit" value="Alterar Produto">

    </form>

    <x-errors/>
</x-template>