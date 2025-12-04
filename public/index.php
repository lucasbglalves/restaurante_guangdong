<?php
// Importa o autoload do Composer para carregar as rotas
require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\UsuarioController;
use App\Controllers\ProdutoController;

function render($view, $data = []) {
    extract($data);
    ob_start();
    require __DIR__ . '/../app/Views/' . $view;
    $content = ob_get_clean();
    require __DIR__ . '/../app/Views/layouts/base.php';
}

function render_sem_template($view, $data = []) {
    extract($data);
    ob_start();
    require __DIR__ . '/../app/Views/' . $view;
}

// Obtem a URL do navegador
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Navegação GERAL
if ($url == "/" || $url === '/index.php') {
    render_sem_template('home.php', [
        'title' => 'Bem-vindo!',
        
    ]);
} else if ($url == "/sobre") {
    render('sobre.php', ['title' => 'Sobre Nós']);  
}
// Usuarios
else if ($url == "/usuarios") {
   // Chama uma instância do controller e chama a função de listar
    $controller = new UsuarioController();
    $controller->listar();
} else if ($url == "/usuarios/inserir") {
    render('usuarios/form_usuarios.php', ['title' => 'Cadastrar Usuário']);  
} else if ($url == "/usuarios/editar") {
    $controller = new UsuarioController();
    $controller->editar();
}
// Produtos
else if ($url == "/produtos") {
    $controller = new ProdutoController();
    $controller->listar();
} else if ($url == "/produtos/inserir") {
    render('produtos/form_produtos.php', ['title' => 'Cadastrar Produto']);  
} else if ($url == "/produtos/editar") {
    $controller = new ProdutoController();
    $controller->editar();
}


else if ($url == "/usuarios/salvar" && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UsuarioController();
    $controller->salvar();
} else if ($url == "/usuarios/atualizar" && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UsuarioController();
    $controller->atualizar();
} else if ($url == "/usuarios/excluir") {
    $controller = new UsuarioController();
    $controller->excluir();
} else if ($url == "/produtos/salvar" && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ProdutoController();
    $controller->salvar();
} else if ($url == "/produtos/atualizar" && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ProdutoController();
    $controller->atualizar();
} else if ($url == "/produtos/excluir") {
    $controller = new ProdutoController();
    $controller->excluir();
}