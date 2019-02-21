<?php

namespace Src\Classes;

class Produto {
  public $id;
  public $nome;
  public $descricao;
  public $und_medida;
  public $id_usr_cad;
  public $id_usr_alter;
  public $criado_em;
  public $ultima_alter;

  public function setId($id) {
    $this->id = $id;
  }

  public function getId() {
    return $this->id;
  }

  public function getNome() {
    return $this->nome;
  }

  public function getUndMedida() {
    return $this->und_medida;
  }
}