<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;
use Core\Session;
use Core\Redirect;
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
      $this->orcamento->setVigenciaInicio($request->post->vigencia_inicio);
      $this->orcamento->setVigenciaFim($request->post->vigencia_fim);
      $this->orcamento->setIdUsrCad(Session::get('usuario')->id);

      for ($i = 0; $i < count($request->post->selectProd); $i++) {
        $produto = new Produto();
        $produto->setId($request->post->selectProd[$i]);
        $ordem = new Ordem($produto, $request->post->qtd_produto[$i]);
        $this->orcamento->addOrdem($ordem);
      }

      $orcamentoModel = Container::getModel('Orcamento');
      $result = $orcamentoModel->insert($this->orcamento);

      if (is_numeric($result)) {        
        Redirect::route('/orcamento');
      } else {
        echo $result;
      }        
    } else {
      $produtoModel = Container::getModel('Produto');
      $this->produtos = $produtoModel->getProducts();

      $this->setPageTitle('Orçamento');
      $this->renderView('orcamento/cadastrar', 'layout');
    }    
  }
  
  public function listar() {
    $this->setPageTitle('Orçamento');
    $this->renderView('orcamento/listar', 'layout');
  }

  public function index() {
    $this->setPageTitle('Gerenciar Orçamento');
    $this->renderView('orcamento/index', 'layout');
  }

  public function aprovar() {
    $this->setPageTitle('Aprovar Orçamentos');
    $this->renderView('orcamento/aprovar', 'layout');
  }
}
?>