<?php

namespace Src\Classes;

class UndMedida {
  public $id;
  public $unidade;
  public $descricao;

  public function setId($id) {
    $this->id = $id;
  }

  public function getId() {
    return $this->id;
  }

  public function getUnidade() {
    return $this->unidade;
  }

  public function setUnidade() {
    return $this->unidade;
  }

  public function setDescricao($descricao) {
    $this->descricao = $descricao;
  }

  public function getDescricao() {
    return $this->descricao;
  }
    
}