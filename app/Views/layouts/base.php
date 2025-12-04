<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg bg-danger bg-gradient">
        <div class="container">
            <a class="navbar-brand text-white fw-bold" href="/">Guangdong</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                        Equipe
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/usuarios">Listagem de usuários</a></li>
                        <li><a class="dropdown-item" href="/usuarios/inserir">Cadastro de usuários</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                        Cardápio
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/produtos">Listagem de produtos</a></li>
                        <li><a class="dropdown-item" href="/produtos/inserir">Cadastro de produtos</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control" type="search" placeholder="Pesquisar..."/>
				<a href="/login.html" class="btn btn-dark ms-2" type="button">Sair</a>
            </form>
            </div>
        </div>
        </nav>

    <div class="container flex-grow-1 py-4">
        <?= $content ?>
    </div>
    

    <footer class="bg-danger bg-gradient p-3 text-center text-white mt-auto">
        <p class="mb-0">Guangdong &copy; 2025 Restaurante Asiático. Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>