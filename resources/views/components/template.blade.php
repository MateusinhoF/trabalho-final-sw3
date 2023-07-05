<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$titulodapagina ?? 'Mateus'}}</title>
</head>
<body>
    <header>
        <h1>
            {{$acessode ?? 'Sem definição de acesso'}}
        </h1>
    </header>
    <section>
        {{$slot}}
    </section>
    <footer>
        
    </footer>
</body>
</html>