<?php

namespace App\Controllers;

use Core\BaseController;

class OrcamentoController extends BaseController
{
  
  public function cadastrar() {
    $this->setPageTitle('Orçamento');
    $this->renderView('orcamento/cadastrar', 'layout');
  }    
}