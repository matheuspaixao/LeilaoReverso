<?php

namespace Src\Classes;

class OrdemDeProposta
{
  private $id;
  private $id_prop_orc;
  private $id_ord_orc;
  private $valor;
  private $aceita;

  public function __construct() {
    //
  }

  public function setId(int $id) {
    $this->id = $id;
  }

  public function getId() {
    return $this->id;
  }

  public function setIdPropOrc($id_prop_orc) {
    $this->id_prop_orc = $id_prop_orc;
  }

  public function getIdPropOrc() {
    return $this->id_prop_orc;
  }

  public function setIdOrdOrc($id_ord_orc) {
    $this->id_ord_orc = $id_ord_orc;
  }

  public function getIdOrdOrc() {
    return $this->id_ord_orc;
  }

  public function setValor($valor) {
    $this->valor = $valor;
  }

  public function getValor() {
    return $this->valor;
  }

  public function setAceita($aceita) {
    $this->aceita = $aceita;
  }

  public function getAceita() {
    return $this->aceita;
  }
}