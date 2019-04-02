<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;
use Core\Session;
use Core\Redirect;
use Src\Classes\Orcamento;
use Src\Classes\Produto;
use Src\Classes\OrdemDeOrcamento as Ordem;

class UsuarioController extends BaseController
{
  protected $produtos;
  protected $orcamento;
  protected $orcamentoDetalhado;
  protected $listaOrcamentos;
  protected $title;
  protected $orcamentoAberto;
  
  public function perfil($usuarioId, $somenteLeitura, $request) {
    $this->setPageTitle('Orçamento');
    $this->renderView('orcamento/cadastrar', 'layout');  
  }
}
