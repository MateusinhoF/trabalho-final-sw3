<x-template titulodapagina="Produto" acessode="Comprador">

    
    <div class="d-flex justify-content-around">
        <x-link href="{{route('comprador.index')}}" texto="Voltar"/>
        <x-link href="{{route('logout')}}" texto="Sair"/>
    </div>
    
    <form action="{{route('comprador.adicionaraocarrinho',['id_produto'=>$produto->id])}}" method="post" class="p-4 p-md-5 border rouded-3 bg-light">
    
        @csrf
        <div class="form-control d-flex">
            <p>Imagem:</p>
            <img src="{{asset('/img/produtos/'.$produto->hash_nome_arquivo)}}" alt="">
        </div>
        <div class="form-control d-flex">
            <p>Nome:</p>
            <p>{{$produto->nome}}</p>
        </div>
        
        <div class="form-control d-flex">
            <p>Descrição:</p>
            <p>{{$produto->descricao}}</p>
        </div>
        <div class="form-control d-flex">
            <p>Quantidade disponivel:</p>
            <p>{{$produto->quantidade - $produto->quantidade_vendido}}</p>
        </div>
        <div class="form-control d-flex">
            <p>Preço:</p>
            <p>R${{str_replace('.',',',$produto->valor_unitario)}}</p>
        </div>
        <div class="form-control d-flex">
            <x-input tipo="text" nome="quantidade" texto="Quantidade"/>
        </div>
        <div class="d-flex justify-content-center">
            <input type="submit" value="Adicionar ao carrinho" class="btn btn-primary">
        </div>
    </form>

    <x-errors/>
</x-template>