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
  protected $aviso = null;

  public function listar() {
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

  public function atualizar($request) {
    if (isset($request->post->atualizar)) { //print_r($request->post); return;
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
  
  public function perfilFornecedora($fornecedoraId) {    
    $usuarioModel = Container::getModel('Usuario');
    $this->fornecedora = $usuarioModel->getUserById($fornecedoraId);

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
