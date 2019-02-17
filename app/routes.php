<?php

$route = [
  ['/login', 'LoginController@index'],
  ['/login/autenticar', 'LoginController@autenticar'],
  ['/', 'HomeController@index'],
  ['/produtos', 'ProdutoController@listar'],
  ['/produtos/cadastrar', 'ProdutoController@cadastrar'],
  ['/produtos/{id}/atualizar', 'ProdutoController@atualizar'],
  ['/produtos/{id}/excluir', 'ProdutoController@excluir'], 
  ['/orcamento/cadastrar', 'OrcamentoController@cadastrar'],
  ['/sair', 'Sair@logout'],
  //['/posts', 'PostsController@index'],
  //['/post/{id}/show', 'PostsController@Show']
];

return $route;