<?php

namespace App\Controllers;

use Core\BaseController;
use Src\Classes\Produto;
use Core\Container;
use Core\Redirect;
use Core\Session;

class FornecedoraController extends BaseController {
    
    public function listar() {
        $this->setPageTitle('Fornecedora');
        $this->renderView('fornecedora/listar_atualizar', 'layout');
    }
}
?>