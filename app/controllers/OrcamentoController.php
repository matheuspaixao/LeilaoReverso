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
  protected $orcamentoDetalhado;
  protected $fornecedoras;
  protected $listaOrcamentos;
  protected $title;
  protected $orcamentoAberto;
  protected $urlForm;
  
  public function cadastrar($request) {
    if (isset($request->post->cadastrar)) { 
      $this->orcamento = new Orcamento();
      $this->orcamento->setNome($request->post->nome);
      $this->orcamento->setAberto(isset($request->post->aberto) ? 1 : 0);
      $this->orcamento->setVigenciaInicio($request->post->vigencia_inicio);
      $this->orcamento->setVigenciaFim($request->post->vigencia_fim);
      $this->orcamento->setIdUsrCad(Session::get('usuario')->id);
      
      for ($i = 0; $i < count($request->post->selectProd); $i++) {
        $produto = new Produto();
        $produto->setId($request->post->selectProd[$i]);
        $ordem = new Ordem($produto, $request->post->qtd_produto[$i]);
        $this->orcamento->addOrdem($ordem);
      }

      for ($i = 0; $i < count($request->post->fornecedoras); $i++)
        $this->orcamento->addFornecedora($request->post->fornecedoras[$i]);

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
      $orcamentoModel = Container::getModel('Orcamento');
      $this->fornecedoras = $orcamentoModel->getFornecedoras();

      $this->setPageTitle('Orçamento');
      $this->renderView('orcamento/cadastrar', 'layout');
    }    
  }

  public function atualizar($orcamentoId, $request) {
    if (isset($request->post->atualizar)) {

    }
    else {
      $orcamentoModel = Container::getModel('Orcamento');
      $orcamento = $orcamentoModel->getOrcamentoByIdToUpdate($orcamentoId);

      if (!empty($orcamento)) {
        if ($orcamento->finalizado == 1) {
          Redirect::route('/orcamento/listar');
        }
        else {
          $this->orcamento = new Orcamento();
          $this->orcamento->setId($orcamento->id);
          $this->orcamento->setNome($orcamento->nome);
          $this->orcamento->setAberto($orcamento->aberto);
          $this->orcamento->setVigenciaInicio($orcamento->vigencia_inicio);
          $this->orcamento->setVigenciaFim($orcamento->vigencia_fim);

          $produtoModel = Container::getModel('Produto');
          $this->produtos = $produtoModel->getProducts();
          $orcamentoModel = Container::getModel('Orcamento');
          $this->fornecedoras = $orcamentoModel->getFornecedoras($orcamentoId);

          $this->setPageTitle('Orcamento');
          $this->renderView('orcamento/atualizar', 'layout');
        }
      }
      else {
        Redirect::route('/orcamento/listar');
      }
    }
  }
  
  public function listar() {
    if (Session::get('usuario')->nivel_acesso > 3) {
      $orcamentoModel = Container::getModel('Orcamento');
      $this->listaOrcamentos = $orcamentoModel->getOrcamentos();
      $this->setPageTitle('Orçamento');
      $this->renderView('orcamento/listarAdm', 'layout');
    }
    else {
      $orcamentoModel = Container::getModel('Orcamento');
      $this->listaOrcamentos = $orcamentoModel->getOrcamentosByFornecedora(Session::get('usuario')->id);
      $this->setPageTitle('Orçamento');
      $this->renderView('orcamento/listarFornecedora', 'layout');
    }
  }

  public function index() {
    $this->setPageTitle('Gerenciar Orçamento');
    $this->renderView('orcamento/index', 'layout');
  }

  public function detalhar($orcamentoId, $request) {
    $orcamentoModel = Container::getModel('Orcamento');
    $this->orcamento = new Orcamento();
    $this->orcamento->setId($orcamentoId);

    if (Session::get('usuario')->nivel_acesso >= 5) {      
      $this->orcamentoDetalhado = $orcamentoModel->getFullOrcamentoById($orcamentoId);
      $this->setPageTitle('Aprovar Orçamentos');
      $this->renderView('orcamento/detalharAdm', 'layout');
    } 
    else {
      $this->orcamentoDetalhado = $orcamentoModel->getOrcamentoByIdAndFornecedora($orcamentoId, Session::get('usuario')->id);

      if (count($this->orcamentoDetalhado) > 0) {  
        $this->urlForm = "/proposta/$orcamentoId/";
        
        if ($this->orcamentoDetalhado[0]->houveProposta == 0)
          $this->urlForm .= "cadastrar";
        else
          $this->urlForm .= $this->orcamentoDetalhado[0]->idPropOrc . "/atualizar";
        
        $this->title = $this->orcamentoDetalhado[0]->nomeOrc;
        $this->orcamentoAberto = $this->orcamentoDetalhado[0]->abertoOrc;
        $this->setPageTitle($this->orcamentoDetalhado[0]->nomeOrc);
        $this->renderView('orcamento/detalharFornecedora', 'layout');
      } 
    }
  }

  public function aprovado($orcamentoId) {
    $orcamentoModel = Container::getModel('Orcamento');
    $this->orcamentoDetalhado = $orcamentoModel->getFullOrcamentoById($orcamentoId);
    $this->setPageTitle('Aprovar Orçamentos');
    $this->renderView('orcamento/orcamentoAprovado', 'layout');
  }
}