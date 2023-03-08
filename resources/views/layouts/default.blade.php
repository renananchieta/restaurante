<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>@yield('titulo')</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg" style="background-color: #3CB371;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Restaurante</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('clientes')}}">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('categorias')}}">Categoria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('produtos')}}">Produto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('cardapio')}}">Cardápio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('pedidos')}}">Pedido</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('encerrarconta')}}">Encerrar conta</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('transferircredito')}}">Transferência de crédito</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('conteudo')
    </div>

    <div class="text-center mt-5">
        DIME PCPA {{ date('d/m/Y') }} 
        
    </div>


</body>

</html>