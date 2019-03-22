<?php

$route = [
  ['/login', 'LoginController@index'],
  ['/login/autenticar', 'LoginController@autenticar'],
  ['/login/esqueci-senha', 'LoginController@esqueciSenha'],
  ['/login/cadastrar', 'LoginController@cadastrar'],
  ['/', 'HomeController@index'],
    
  ['/produtos', 'ProdutoController@listar'],
  ['/produtos/cadastrar', 'ProdutoController@cadastrar'],
  ['/produtos/{id}/atualizar', 'ProdutoController@atualizar'],
  ['/produtos/{id}/excluir', 'ProdutoController@excluir'], 
 
  ['/orcamento/index', 'OrcamentoController@index'],
  ['/orcamento/cadastrar', 'OrcamentoController@cadastrar'],
  ['/orcamento/listar', 'OrcamentoController@listar'],
  ['/fornecedora/listar_atualizar', 'FornecedoraController@listar'],
  ['/sair', 'Sair@logout'],
  ['/teste', 'TesteController@index']
  //['/posts', 'PostsController@index'],
  //['/post/{id}/show', 'PostsController@Show']
];

return $route;