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
        

    </head>
    <body class="bg-gray-100 dark:bg-gray-900">
        <header>
            <div class="menu">
                <ul>
                    <li><a href="http://127.0.0.1:8000/">Home</a></li>
                    <li><a href="http://127.0.0.1:8000/registrarEncomendas">Registrar Encomenda</a></li>
                </ul>
            </div>
        </header>
        <div>
            <h1><strong>Relatório de pedidos já registrados</strong></h1>

            <div class="container">
                <div class="col">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Produto</th>
                                <th>Local de partida</th>
                                <th>Local de destino</th>
                                <th>Valor do frete</th>
                                <th>Data da entrega</th>
                                <th>Descrição</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedidos as $pedido)
                                <tr>
                                    <td>{{ $pedido['cliente'] }}</td>
                                    <td>{{ $pedido['produto'] }}</td>
                                    <td>{{ $pedido['local_partida'] }}</td>
                                    <td>{{ $pedido['local_destino'] }}</td>
                                    <td>R$ {{ $pedido['valor_frete'] }}</td>
                                    <td>{{ $pedido['data_entrega'] }}</td>
                                    <td>{{ $pedido['descricao'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>