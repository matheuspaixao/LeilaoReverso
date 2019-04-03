<?php

namespace App\Models;

use Core\BaseModel;
use PDO;
use PDOException;
use Src\Classes\PropostaOrcamento as ObjOrcamento;
use Src\Classes\OrdemDeProposta as ObjOrdem;

class PropostaOrcamento extends BaseModel
{

  public function insert(ObjOrcamento $orcamento) {
    try {
      $this->pdo->beginTransaction();

      // inserir primeiro a proposta
      $queryOrc = "INSERT INTO propostadeorcamento(id_orcamento, id_fornecedor, aberto) VALUES(?, ?, ?)";
      $sqlOrc = $this->pdo->prepare($queryOrc);
      $sqlOrc->execute(array(
        $orcamento->getIdOrcamento(),
        $orcamento->getIdFornecedor(),
        $orcamento->getAberto()
      ));

      $id_pro_orc = $this->pdo->lastInsertId();

      $queryOrdem = "INSERT INTO ordensdeorcamento(id_prop_orc, id_ord_orc, valor) VALUES(?, ?, ?)";
      $sqlOrdem = $this->pdo->prepare($queryOrdem);

      foreach ($orcamento->getOrdens() as $ordem) {
        $sqlOrdem->execute(array(
          $id_pro_orc,
          $ordem->getIdOrdOrc(),
          $ordem->getValor()
        ));
      }

      $this->pdo->commit();

      return $id_pro_orc;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
}
