<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Registrar encomenda</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }

            input, select, textarea {
                margin-bottom: 30px;
                border: groove 0.5px;
            }
            h1 {
                color: white;
            }

            .container-formulario {
                width: 350px;
                margin: auto;
            }
        </style>
    </head>
    <body class="antialiased">
        <header>
            <div class="menu">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/encomendas">Relatório de Encomenda</a></li>
                </ul>
            </div>
        </header>

        <div class="container-formulario">
            @if($salvo != null && $salvo)
                <div class="alert alert-primary" role="alert">
                    <p>Encomenda registrada com sucesso!</p>
                </div>
            @elseif($salvo != null && !$salvo)
                <div class="alert alert-danger" role="alert">
                    <p>Erro ao registrar encomenda, contate o administrador.</p>
                </div>
            @endif
            <div class="form-control form-control-lg">
                <h2 class="text-center"><strong>Registro de encomenda</strong></h2>
                <form action="/salvarEncomendas" method="POST">
                    @csrf
                    <label for="data_entrega"><b>Data da entrega:</b></label><br>
                    <input type="date" name="data_entrega" id="data_entrega"><br>

                    <label for="valor_frete"><b>Valor do frete:</b></label><br>
                    <input type="text" name="valor_frete" id="valor_frete"><br>

                    <label for="cliente"><b>Cliente:</b></label><br>
                    <select name="cliente" id="cliente">
                        <option value="0">Selecione uma opção</option>
                        @foreach($clientes as $cliente)
                            <option value="{{$cliente['id']}}">{{$cliente['nome']}}</option>
                        @endforeach
                    </select><br>

                    <label for="produto"><b>Produto:</b></label><br>
                    <select name="produto" id="produto">
                        <option value="0">Selecione uma opção</option>
                        @foreach($produtos as $produto)
                            <option value="{{$produto['id']}}">{{$produto['nome']}}</option>
                        @endforeach
                    </select><br>

                    <label for="local_partida"><b>Local de partida:</b></label><br>
                    <input type="text" name="local_partida" id="local_partida"><br>

                    <label for="local_destino"><b>Local de destino:</b></label><br>
                    <input type="text" name="local_destino" id="local_destino"><br>

                    <label for="descricao"><b>Descrição/cuidados:</b></label><br>
                    <textarea name="descricao" id="descricao"></textarea><br>

                    <input type="submit" value="Enviar" class="btn btn-secondary">
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
