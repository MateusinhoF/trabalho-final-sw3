<x-template titulodapagina="Editar Produto" acessode="Vendedor">

    <div class="d-flex justify-content-around">
        <x-link href="{{route('vendedor.index')}}" texto="Voltar"/>
        <x-link href="{{route('logout')}}" texto="Sair"/>
    </div>

    <form action="{{route('vendedor.update',['id'=>$produto->id])}}" method="post" enctype="multipart/form-data" class="p-4 p-md-5 border rouded-3 bg-light">
    
        @csrf
        <x-input nome="nome" texto="Nome" tipo="text" valor="{{$produto->nome}}"/>
        <x-input nome="descricao" texto="Descricao" tipo="text" valor="{{$produto->descricao}}"/>
        <x-input nome="valor_unitario" texto="Valor Unitario" tipo="text" valor="{{str_replace('.',',',$produto->valor_unitario)}}"/>
        <x-input nome="quantidade" texto="Quantidade" tipo="text" valor="{{$produto->quantidade}}"/>
        <x-input nome="quantidade_vendido" texto="Quantidade Vendido" tipo="text" valor="{{$produto->quantidade_vendido}}"/>
        
        
        <div class="form-group mb-3">
            <label for="imagem">Imagem Atual</label>
            <img src="{{asset('/img/produtos/'.$produto->hash_nome_arquivo)}}" alt="">
        </div>

        <div class="form-group mb-3">
            <label for="imagem">Nova Imagem</label>
            <input type="file" name="imagem" id="imagem">
        </div>

        <div class="d-flex justify-content-center">
            <input type="submit" value="Alterar Produto" class="btn btn-primary">
        </div>

    </form>

    <x-errors/>
</x-template>