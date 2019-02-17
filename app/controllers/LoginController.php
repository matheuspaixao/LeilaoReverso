<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;
use Core\Redirect;
use Core\Session;

class LoginController extends BaseController 
{
  protected $aviso = null;

  public function index() {
    if (Session::get('avisoLogin')) {
      $this->aviso = Session::get('avisoLogin');
      Session::destroy('avisoLogin');
    }

    $this->setPageTitle('Login');
    $this->renderView('login/index', 'layout');
  }

  public function autenticar($request) {
    $loginModel = Container::getModel('Login');
    $usuario = $loginModel->getUserById($request->post->login);

    if (count($usuario) == 0) {
      Redirect::route('/login', [
        'avisoLogin' => 'Usuário não encontrado!'
      ]);
    }      
    else if ($usuario->senha !== $request->post->senha) {
      Redirect::route('/login', [
        'avisoLogin' => 'Senha incorreta!'
      ]);      
    }
    else {
      Session::set('usuario', $usuario);
      Redirect::route('/');
    }
  }  
}