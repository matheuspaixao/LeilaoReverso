<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;
use Core\Session;
use Src\Classes\Orcamento;
use Src\Classes\Produto;
use Src\Classes\OrdemDeOrcamento as Ordem;

class OrcamentoController extends BaseController
{
  protected $produtos;
  protected $orcamento;
  
  public function cadastrar($request) {
    if (isset($request->post->nome)) {
      $this->orcamento = new Orcamento();
      $this->orcamento->setNome($request->post->nome);
      $this->orcamento->setAberto(isset($request->post->aberto));
      $this->orcamento->setIdUsrCad(Session::get('usuario')->id);

      for ($i = 0; $i < count($request->post->selectProd); $i++) {
        $produto = new Produto();
        $produto->setId($request->post->selectProd[$i]);
        $ordem = new Ordem($produto, $request->post->qtd_produto[$i]);
        $this->orcamento->addOrdem($ordem);
      }

      $orcamentoModel = Container::getModel('Orcamento');
      $result = $orcamentoModel->insert($this->orcamento);

      if ($result !== true)
        echo $result;

      // echo '<pre>';
      // print_r($this->orcamento);
      // echo '</pre>';
    } else {
      $produtoModel = Container::getModel('Produto');
      $this->produtos = $produtoModel->getProducts();

      $this->setPageTitle('Orçamento');
      $this->renderView('orcamento/cadastrar', 'layout');
    }    
  }
}