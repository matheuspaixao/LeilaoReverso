<?php

namespace App\Controllers;

use Core\BaseController;
use Src\Classes\Produto;
use Core\Container;
use Core\Redirect;
use Core\Session;

class FornecedoraController extends BaseController {
    
  protected $aviso = null;
  protected $fornecedoras;

  public function listar() {
    if (Session::get('aviso')) {
      $this->aviso = Session::get('aviso');
      Session::destroy('aviso');
    }

    $fornecedoraModel = Container::getModel('Fornecedora');
    $this->fornecedoras = $fornecedoraModel->getFornecedoras();
    $this->setPageTitle('Fornecedora');
    $this->renderView('fornecedora/listar', 'layout');
  }

  public function aprovar($fornecedoraId) {
    if (is_numeric($fornecedoraId)) {
      $fornecedoraModel = Container::getModel('Fornecedora');
      $result = $fornecedoraModel->aprovarFornecedora($fornecedoraId);

      if (is_numeric($result))
        Redirect::route('/fornecedora/listar');
      else
        print_r($result);
    } else {
      Redirect::route('/fornecedora/listar');
    }    
  }

  public function recusar($fornecedoraId) {
    if (is_numeric($fornecedoraId)) {
      $fornecedoraModel = Container::getModel('Fornecedora');
      $result = $fornecedoraModel->deletarFornecedora($fornecedoraId);

      if (is_numeric($result))
        Redirect::route('/fornecedora/listar');
      else
        print_r($result);
    } else {
      Redirect::route('/fornecedora/listar');
    }    
  }
}
?>