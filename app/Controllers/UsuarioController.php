<?php
namespace App\Controllers;

use App\Models\Usuario;

class UsuarioController {

    //Busca os usuários e chama a tela de listar

        public function listar() {
        $lista_usuarios = Usuario::buscarTodos();
        render('usuarios/lista_usuarios.php', ['title' => 'Lista de Usuários', 'usuarios' => $lista_usuarios]);
    }

    public function create() {
        render('usuarios/form_usuarios.php', ['title' => 'Novo Usuário']);
    }

    public function store() {
        Usuario::create($_POST);
        header('Location: /usuarios');
    }

    public function edit($id) {
        $usuario = Usuario::find($id);
        render('usuarios/form_usuarios.php', ['title' => 'Editar Usuário', 'usuario' => $usuario]);
    }

    public function update($id) {
        Usuario::update($id, $_POST);
        header('Location: /usuarios');
    }

    public function delete($id) {
        Usuario::delete($id);
        header('Location: /usuarios');
    }
}