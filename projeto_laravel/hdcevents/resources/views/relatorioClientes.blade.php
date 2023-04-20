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
                    <li><a href="/">Home</a></li>
                    <li><a href="/registrarClientes">Registrar Cliente</a></li>
                </ul>
            </div>
        </header>
        <div>
            <h1><strong>Relatório de Clientes Cadastrados</strong></h1>

            <div class="container">
                <div class="col">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Endereço</th>
                                <th>Aniversário</th>
                                <th>CPF</th>
                                <th>RG</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($clientes) > 0)
                                @foreach($clientes as $cliente)
                                    <tr>
                                        <td>{{ $cliente['nome'] }}</td>
                                        <td>{{ $cliente['endereco'] }}</td>
                                        <td>{{ $cliente['aniversario'] }}</td>
                                        <td>{{ $cliente['cpf'] }}</td>
                                        <td>{{ $cliente['rg'] }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" style="text-align: center;">Nenhum registro encontrado</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>