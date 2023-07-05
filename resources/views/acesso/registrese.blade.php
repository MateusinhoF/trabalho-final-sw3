<x-template titulodapagina="Registre-se" acessode="Criar Cadastro">

    <a href="{{route('login')}}">Login</a>

    <form action="{{route('store')}}" method="post">
        @csrf
        Nome
        <input type="text" name="name" id="name">
        Email
        <input type="email" name="email" id="email">
        Senha
        <input type="password" name="password" id="password">
        Tipo de Usuario
        <select name="tipo_de_usuario" id="tipo_de_usuario">
            @foreach ($tipoDeUsuario as $tipo)
                <option value="{{$tipo->id}}">{{$tipo->tipo}}</option>
            @endforeach
        </select>
        Cidade
        <input type="text" name="cidade" id="cidade">
        Bairro
        <input type="text" name="bairro" id="bairro">
        Rua
        <input type="text" name="rua" id="rua">
        Numero
        <input type="text" name="numero" id="numero">

        <input type="submit" value="Cadastrar">
    </form>

    <x-errors/>
</x-template>