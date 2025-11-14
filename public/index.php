<?php
// Importa o autoload do Composer para carregar as rotas
require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\UsuarioController;

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
}
// Produtos
else if ($url == "/produtos") {
    render('produtos/lista_produtos.php', ['title' => 'Listar Produtos']);  
} else if ($url == "/produtos/inserir") {
    render('produtos/form_produtos.php', ['title' => 'Cadastrar Produto']);  
} 
