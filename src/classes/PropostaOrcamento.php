<?php

namespace Src\Classes;

use ArrayObject;

class PropostaOrcamento
{
  public $id;
  public $id_orcamento;
  public $id_fornecedor;
  public $aberto;
  public $aceita;
  public $data;
  public $ordens;

  public function __construct() {
    $this->ordens = new ArrayObject();
  }

  public function addOrdem(OrdemDeProposta $ordem) {
    $this->ordens->offsetSet($ordem->getId(), $ordem);
  }

  public function delOrdem(OrdemDeProposta $ordem) {
    $this->ordens->offsetUnset($ordem->getId());
  }

  public function findOrdem(OrdemDeProposta $ordem) {
    $this->ordens->offsetExists($ordem->getId());
  }

  public function getOrdens() {
    return $this->ordens;
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getIdOrcamento() {
    return $this->id_orcamento;
  }

  public function setIdOrcamento($id_orcamento) {
    $this->id_orcamento = $id_orcamento;
  } 
  
  public function getIdFornecedor() {
    return $this->id_fornecedor;
  }

  public function setIdFornecedor($id_fornecedor) {
    $this->id_fornecedor = $id_fornecedor;
  }

  public function getAberto() {
    return $this->aberto;
  }

  public function setAberto($aberto) {
    $this->aberto = $aberto;
  }

  public function getAceita() {
    return $this->aceita;
  }

  public function setAceita($aceita) {
    $this->aceita = $aceita;
  }

  public function getData() {
    return $this->data;
  }

  public function setData($data) {
    $this->data = $data;
  }  
}