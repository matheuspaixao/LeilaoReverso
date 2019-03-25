<?php

namespace App\Controllers;

use Core\BaseController;
use Src\Classes\Produto;
use Core\Container;
use Core\Redirect;
use Core\Session;

class TesteController extends BaseController {
    protected $val;    
    
    public function index() {
        $this->val = "Hugo lindao";
        $this->setPageTitle('Teste');
        $this->renderView('teste/index', 'layout');
    }
}
?>