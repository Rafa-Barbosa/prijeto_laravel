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
                margin-top: 50px;
            }
        </style>
    </head>
    <body class="antialiased">
        <header>
            <div class="menu">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/relatorioClientes">Relatório de Clientes</a></li>
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
                <h2 class="text-center"><strong>Registro de Clientes</strong></h2>

                <form action="/salvarClientes" method="POST">
                    @csrf
                    
                    <label for="nome">Nome</label><br>
                    <input type="text" name="nome" id="nome"><br>

                    <label for="endereco">Endereço</label><br>
                    <input type="text" name="endereco" id="endereco"><br>

                    <label for="aniversario">Aniversário</label><br>
                    <input type="date" name="aniversario" id="aniversario"><br>

                    <label for="cpf">CPF</label><br>
                    <input type="text" name="cpf" id="cpf"><br>

                    <label for="rg">RG</label><br>
                    <input type="number" name="rg" id="rg"><br>

                    <input type="submit" value="Enviar" class="btn btn-secondary">
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
