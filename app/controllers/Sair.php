<?php

namespace App\Controllers;

use Core\Session;
use Core\Redirect;

class Sair
{
  public function logout() {
    Session::destroy('usuario');
    session_destroy();
    Redirect::route('/login');
  }
}