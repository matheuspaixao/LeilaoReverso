<?php

namespace App\Controllers;

use Core\BaseController;
use Core\Container;
use Core\Session;
use Core\Redirect;
use Src\Classes\PropostaOrcamento;
use Src\Classes\OrdemDeProposta;

class PropostaController extends BaseController
{

  public function cadastrar($orcamentoId, $request) {
    $proposta = new PropostaOrcamento();
    $proposta->setIdFornecedor(Session::get('usuario')->id);
    $proposta->setIdOrcamento($orcamentoId);
    $proposta->setAberto(0);

    for ($i = 0; $i < count($request->post->valor); $i++) {
      $valor = str_replace(',', '-', $request->post->valor[$i]);
      $valor = str_replace('.', ',', $valor);
      $valor = str_replace('-', '.', $valor);

      $ordem = new OrdemDeProposta();
      $ordem->setIdOrdOrc($request->post->id_ord_orc[$i]);
      $ordem->setValor($valor);
      $proposta->addOrdem($ordem);
    }    
    
    $propostaModel = Container::getModel('PropostaOrcamento');
    $result = $propostaModel->insert($proposta);

    if (is_numeric($result)) {        
      Redirect::route('/orcamento/listar/'. $orcamentoId);
    } else {
      echo $result;
    }  
  }

  public function atualizar($orcamentoId, $propostaId, $request) {
    $proposta = new PropostaOrcamento;
    
    for ($i = 0; $i < count($request->post->valor); $i++) {
      $valor = str_replace(',', '-', $request->post->valor[$i]);
      $valor = str_replace('.', ',', $valor);
      $valor = str_replace('-', '.', $valor);
      
      $ordem = new OrdemDeProposta();
      $ordem->setId($request->post->id_ord_prop[$i]);
      $ordem->setValor($valor);
      $proposta->addOrdem($ordem);
    } 
    
    $propostaModel = Container::getModel('PropostaOrcamento');
    $result = $propostaModel->update($proposta);

    if (is_numeric($result)) {        
      Redirect::route('/orcamento/listar/'. $orcamentoId);
    } else {
      echo $result;
    } 
  }

  public function aprovar($orcamentoId, $request) {
    $propostaModel = Container::getModel('PropostaOrcamento');
    $result = $propostaModel->aprovar($orcamentoId, $request->post->idProposta);

    if (is_numeric($result)) {        
      Redirect::route('/orcamento/listar');
    } else {
      echo $result;
    }
  }
}
