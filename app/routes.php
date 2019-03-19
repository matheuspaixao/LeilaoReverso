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
  ['/orcamento/cadastrar', 'OrcamentoController@cadastrar'],
  ['/fornecedora/listar_atualizar', 'FornecedoraController@listar'],
  ['/sair', 'Sair@logout']
];

return $route;