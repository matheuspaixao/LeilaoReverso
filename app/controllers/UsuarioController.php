<?php

namespace App\Controllers;

use Core\BaseController;
use Src\Classes\Produto;
use Core\Container;
use Core\Redirect;
use Core\Session;

class UsuarioController extends BaseController {   
    public function index() {
        $this->setPageTitle('Usuários');
        $this->renderView('usuario/index', 'layout');
    }

    public function cadastrar() {
        $this->setPageTitle('Cadastrar Usuários');
        $this->renderView('usuario/cadastrar', 'layout');
    }
}
