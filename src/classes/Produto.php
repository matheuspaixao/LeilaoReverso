<?php

namespace Src\Classes;

class Produto {
  public $id;
  public $nome;
  public $descricao;
  public $id_und_medida;
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

  public function setIdUndMedida($id_und_medida) {
    $this->id_und_medida = $id_und_medida;
  }

  public function getIdUndMedida() {
    return $this->id_und_medida;
  }
}