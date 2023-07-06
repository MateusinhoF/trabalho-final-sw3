<x-template titulodapagina="Registre-se" acessode="Criar Cadastro">

    <x-link  href="{{route('login')}}" texto="Login"/>

    <form action="{{route('store')}}" method="post" class="p-4 p-md-5 border rouded-3 bg-light">
        @csrf

        <x-input nome="nome" texto="Nome" tipo="text"/>

        <x-input nome="email" texto="E-mail" tipo="email"/>
       
        <x-input nome="password" texto="password" tipo="password"/>

        <x-input nome="email" texto="E-mail" tipo="email"/>


        Tipo de Usuario
        <select name="tipo_de_usuario" id="tipo_de_usuario" class="form-control">
            @foreach ($tipoDeUsuario as $tipo)
                <option value="{{$tipo->id}}">{{$tipo->tipo}}</option>
            @endforeach
        </select>

        <x-input nome="cidade" texto="Cidade" tipo="text"/>
        
        <x-input nome="bairro" texto="Bairro" tipo="text"/>
        
        <x-input nome="rua" texto="Rua" tipo="text"/>
        
        <x-input nome="numero" texto="Numero" tipo="text"/>

        <input type="submit" value="Cadastrar" class="btn btn-primary">
    </form>

    <x-errors/>
</x-template>