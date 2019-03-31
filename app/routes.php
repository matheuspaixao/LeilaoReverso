<?php

$route = [
  ['/adm', 'AdmController@index', 10],

  ['/login', 'LoginController@index', 0],
  ['/login/autenticar', 'LoginController@autenticar', 0],
  ['/login/esqueci-senha', 'LoginController@esqueciSenha', 0],
  ['/login/cadastrar', 'LoginController@cadastrarFornecedora', 0],
  ['/', 'HomeController@index', 1],
  ['/login/verificarUsuario/{login}', 'LoginController@verificarUsuario', 0],
    
  ['/produtos', 'ProdutoController@listar', 5],
  ['/produtos/cadastrar', 'ProdutoController@cadastrar', 5],
  ['/produtos/{id}/atualizar', 'ProdutoController@atualizar', 5],
  ['/produtos/{id}/excluir', 'ProdutoController@excluir', 5], 
 
  ['/orcamento', 'OrcamentoController@index', 3],
  ['/orcamento/cadastrar', 'OrcamentoController@cadastrar', 5],
  ['/orcamento/listar', 'OrcamentoController@listar', 3],
  ['/orcamento/aprovar', 'OrcamentoController@aprovar', 3],

  ['/usuario', 'UsuarioController@index', 10],
  ['/usuario/cadastrar', 'UsuarioController@cadastrar', 10],

  ['/fornecedora/listar', 'FornecedoraController@listar', 5],
  ['/fornecedora/{fornecedoraId}/aprovar', 'FornecedoraController@aprovar', 5],

  ['/sair', 'Sair@logout', 1],
];

return $route;