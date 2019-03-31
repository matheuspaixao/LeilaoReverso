<?php

namespace Core;

class Route {

  private $routes;

  public function __construct(array $routes) {
    $this->setRoutes($routes);
    $this->run();
  }

  private function setRoutes($routes) {
    foreach ($routes as $route) {
      $explode = explode('@', $route[1]);
      $r = [$route[0], $explode[0], $explode[1], $route[2]];
      $newRoutes[] = $r;
    }

    $this->routes = $newRoutes;
  }

  private function getRequest() {
    $obj = new \stdClass;
        
    $get  = (object) $_GET;
    $post = (object) $_POST;

    $obj->get = $get;
    $obj->post = $post;
    
    return $obj;  
  }
  
  private function getUrl() {
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  }

  private function run() {
    $url = $this->getUrl();
    $urlArray = explode('/', $url);

    foreach($this->routes as $route) {
      $routeArray = explode('/', $route[0]);
      $param = array();

      for ($i = 0; $i < count($routeArray); $i++) {
        if (strpos($routeArray[$i], '{') !== false && count($urlArray) == count($routeArray)) {
          $routeArray[$i] = $urlArray[$i];
          $param[] = $urlArray[$i];
        }

        $route[0] = implode($routeArray, '/');
      }      

      if ($found = ($url == $route[0])) {
        $controller = $route[1];
        $action = $route[2];
        $nivel_acesso = $route[3];
        break;
      }
    }

    if ($found) {
      if (!Session::get('usuario') && $controller !== 'LoginController') {
        Redirect::route('/login');
        return;
      }

      if ($controller !== 'LoginController' && Session::get('usuario')->nivel_acesso < $nivel_acesso) {
        Container::noAccess();
        return;
      }      

      $controller = Container::newController($controller);
      
      switch (count($param)) {
        case 1: 
          $controller->$action($param[0], $this->getRequest());
          break;
        case 2: 
          $controller->$action($param[0], $param[1], $this->getRequest());
          break;
        case 3: 
          $controller->$action($param[0], $param[1], $param[2], $this->getRequest());
          break;
        default:
          $controller->$action($this->getRequest());
      }
    }
    else {
      Container::pageNotFound();
    }
  }
}