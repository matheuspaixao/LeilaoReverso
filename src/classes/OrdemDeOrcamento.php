<?php

namespace Src\Classes;

class OrdemDeOrcamento
{
  private $id;
  private $produto;
  private $qtd;

  public function __construct(Produto $produto, $quantidade) {
    $this->produto = $produto;
    $this->qtd = $quantidade;
  }

  public function setId(int $id) {
    $this->id = $id;
  }

  public function getId() {
    return $this->id;
  }

  public function setProduto(Produto $produto) {
    $this->produto = $produto;
  }

  public function getProduto() {
    return $this->produto;
  }

  public function setQtd(int $qtd) {
    $this->qtd = $qtd;
  }

  public function getQtd() {
    return $this->qtd;
  }
}