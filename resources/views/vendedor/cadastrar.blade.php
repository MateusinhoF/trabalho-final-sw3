<x-template titulodapagina="Cadastrar Produto" acessode="Vendedor">

    <a href="{{route('vendedor.index')}}">Voltar</a>
    <a href="{{route('logout')}}">Sair</a>

    <form action="{{route('vendedor.store')}}" method="post" enctype="multipart/form-data">
    
        @csrf
        Nome
        <input type="text" name="nome" id="nome">
        Descricao
        <input type="text" name="descricao" id="descricao">
        Valor Unitario
        <input type="text" name="valor_unitario" id="valor_unitario">
        Quantidade
        <input type="text" name="quantidade" id="quantidade">
        Imagem
        <input type="file" name="imagem" id="imagem">

        <input type="submit" value="Cadastrar Produto">

    </form>

    <x-errors/>
</x-template>