<?php

namespace App\Controllers;

use Core\BaseController;
use Src\Classes\Produto;
use Core\Container;
use Core\Redirect;
use Core\Session;

class AdmController extends BaseController {   
    public function index() {
        $this->setPageTitle('Administrador');
        $this->renderView('adm/index', 'layout');
    }
}
?>