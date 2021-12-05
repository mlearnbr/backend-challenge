<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\AccessLevel;
use MF\Controller\Action;

class IndexController extends Action {

    

    public function index()
    {
        $this->view->dados = 'a' ;
        $this->render('index');
    }
    public function usuario()
    {
        $id = $_GET['id'];
        $access_level = new AccessLevel();

        $usuario = new Usuario($id);
        $usuario->fetch();
        $this->view->dados = $usuario;
        $this->view->access_level = $access_level->fetchAll();
        $this->render('usuario');
    }
    public function usuarios()
    {

        $usuario = new Usuario();
        $usuarios = $usuario->fetchAll();


        $this->view->dados = $usuarios;
        $this->render('usuarios');
    }
    public function usuarioInsert()
    {

        $nome = $_POST['nome'];
        $tel = $_POST['tel'];
        $senha = $_POST['senha'];

        $usuario = new Usuario(null,$nome,$tel,1,$senha);

        if ($usuario->salvar()) {
            $arr_result = ['success' => 1, 'error' => 0];
        } else {
            $arr_result = ['success' => 0, 'error' => 1];
        }
        echo json_encode($arr_result);
    }
    public function usuarioTrocaLevel()
    {

        $id = $_POST['id'];
        $user = $_POST['user'];

        $usuario = new Usuario($user);
        $usuario->fetch();
        $usuario->novoLevel($id);
        if ($usuario->novoLevel($id)) {
            $arr_result = ['success' => 1, 'error' => 0];
        } else {
            $arr_result = ['success' => 0, 'error' => 1];
        }
        echo json_encode($arr_result);
    }
    
    
}