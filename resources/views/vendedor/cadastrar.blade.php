<x-template titulodapagina="Cadastrar Produto" acessode="Vendedor">

    <div class="d-flex justify-content-around">
        <x-link href="{{route('vendedor.index')}}" texto="Voltar"/>
        <x-link href="{{route('logout')}}" texto="Sair"/>
    </div>

    <form action="{{route('vendedor.store')}}" method="post" enctype="multipart/form-data" class="p-4 p-md-5 border rouded-3 bg-light">
    
        @csrf

        <x-input nome="nome" texto="Nome" tipo="text"/>
        <x-input nome="descricao" texto="Descrição" tipo="text"/>
        <x-input nome="valor_unitario" texto="Valor Unitario" tipo="text"/>
        <x-input nome="quantidade" texto="Quantidade" tipo="text"/>
        
        <div class="form-group mb-3">
            <label for="imagem">Imagem</label>
            <input type="file" name="imagem" id="imagem">
        </div>

        <div class="d-flex justify-content-center">
            <input type="submit" value="Cadastrar Produto" class="btn btn-primary">
        </div>

    </form>

    <x-errors/>
</x-template>