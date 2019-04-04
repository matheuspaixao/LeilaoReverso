<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;
use Core\Session;
use Core\Redirect;

class UsuarioController extends BaseController
{
  protected $title;
  protected $fornecedora;
  protected $usuarios;
  protected $aviso = null;

  public function listar() {
    $usuarioModel = Container::getModel('Usuario');
    $this->usuarios = $usuarioModel->getUsers();
    
    $this->setPageTitle('Usuários');
    $this->renderView('Usuario/listar', 'layout');  
  }
  
  public function meuPerfil() {
    if (Session::get('aviso')) {
      $this->aviso = Session::get('aviso');
      Session::destroy('aviso');
    }

    $this->setPageTitle('Meu Perfil');
    $this->renderView('Usuario/meu-perfil', 'layout');  
  }

  public function cadastrar($request) {
    if (isset($request->post->cadastrar)) {
      $usuarioModel = Container::getModel('Usuario');
      $usuario = $request->post;
      $usuario->tipo_usuario = 'Funcionario';
      $result = $usuarioModel->insert($usuario);

      if (is_numeric($result)) {
        Redirect::route('/usuarios');
      } else {
        Redirect::route('/usuarios', [
          'aviso' => $result
        ]);
      }
    }
    else {
      $this->setPageTitle('Cadastrar Usuário');
      $this->renderView('Usuario/cadastrar', 'layout');  
    }
  }

  public function atualizar($request) {
    if (isset($request->post->atualizar)) { 
      $usuarioModel = Container::getModel('Usuario');
      $result = $usuarioModel->update(Session::get('usuario')->id, $request->post);

      if (is_numeric($result)) {
        $usuario = $usuarioModel->getUserByLogin(Session::get('usuario')->login);
        Session::destroy('usuario');
        Session::set('usuario', $usuario);
        Redirect::route('/meuperfil');
      } else {
        Redirect::route('/meuperfil', [
          'aviso' => $result
        ]);
      }
    }
  }
  
  public function perfil($usuarioId) {    
    $usuarioModel = Container::getModel('Usuario');
    $this->fornecedora = $usuarioModel->getUserById($usuarioId);

    if (empty($this->fornecedora)) {
      Redirect::route('/fornecedora/listar', [
        'aviso' => 'Fornecedora não encontrada!'
      ]);
    } 
    else {
      $this->title = $this->fornecedora->nome;
      $this->setPageTitle('Perfil Fornecedora');
      $this->renderView('Fornecedora/perfil', 'layout');  
    }
  }  
}
