<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Tray Vendas</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">Tray Vendas</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="vendedorDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Vendedor
                        </a>
                        <div class="dropdown-menu" aria-labelledby="vendedorDropdown">
                            <a class="dropdown-item" href="/sellerCreate">Criar Vendedor</a>
                            <a class="dropdown-item" href="/sellerList" >Listagem Vendedores</a>
                        </div>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="vendasDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Vendas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="vendasDropdown">
                            <a class="dropdown-item" href="/saleCreate">Criar Venda</a>
                            <a class="dropdown-item" href="/saleList">Listar Vendas</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="reportDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Relátorio
                        </a>
                        <div class="dropdown-menu" aria-labelledby="reportDropdown">
                            <a class="dropdown-item" href="/report">Gerar relatório</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    
    <div class="container">

        @yield('content')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
         function validarNumerosInteiros(input) {

            input.value = input.value.replace(/[^0-9]/g, '');
        }
    </script>

</body>
</html>
