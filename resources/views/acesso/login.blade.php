<x-template titulodapagina="Login" acessode="Login">

    <a href="{{route('registrese')}}">Registre-se</a>

    <form action="{{route('logar')}}" method="post">
        @csrf
        Email
        <input type="email" name="email" id="email">
        Senha
        <input type="password" name="password" id="password">

        <input type="submit" value="Entrar">
    </form>

    <x-errors/>
</x-template>