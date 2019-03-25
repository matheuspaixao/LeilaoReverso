<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Session;

class HomeController extends BaseController 
{

  public function index() {
    $this->setPageTitle('Home');
    $this->renderView('home/index', 'layout');
  }
}
?>