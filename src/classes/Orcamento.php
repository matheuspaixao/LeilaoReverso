<?php

namespace Src\Classes;

use ArrayObject;

class Orcamento
{
  public $id;
  public $nome;
  public $aberto;
  public $vigencia_inicio;
  public $vigencia_fim;
  public $ordens;
  public $id_usr_cad;
  public $id_usr_alter;
  public $criado_em;
  public $ultima_alter;

  public function __construct() {
    $this->ordens = new ArrayObject();
  }

  public function addOrdem(OrdemDeOrcamento $ordem) {
    $this->ordens->offsetSet($ordem->getId(), $ordem);
  }

  public function delOrdem(OrdemDeOrcamento $ordem) {
    $this->ordens->offsetUnset($ordem->getId());
  }

  public function findOrdem(OrdemDeOrcamento $ordem) {
    $this->ordens->offsetExists($ordem->getId());
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getNome() {
    return $this->nome;
  }

  public function setNome($nome) {
    $this->nome = $nome;
  }  

  public function getAberto() {
    return $this->aberto;
  }

  public function setAberto($aberto) {
    $this->aberto = $aberto;
  }

  public function getVigenciaInicio() {
    return $this->vigencia_inicio;
  }

  public function setVigenciaInicio($vigencia_inicio) {
    $this->vigencia_inicio = $vigencia_inicio;
  }

  public function getVigenciaFim() {
    return $this->vigencia_fim;
  }

  public function setVigenciaFim($vigencia_fim) {
    $this->vigencia_fim = $vigencia_fim;
  }

  public function getOrdens() {
    return $this->ordens;
  }

  public function getIdUsrCad() {
    return $this->id_usr_cad;
  }

  public function setIdUsrCad($id) {
    $this->id_usr_cad = $id;
  }
}