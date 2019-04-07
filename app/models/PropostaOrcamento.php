<?php

namespace App\Models;

use Core\BaseModel;
use PDO;
use PDOException;
use Src\Classes\PropostaOrcamento as ObjProposta;
use Src\Classes\OrdemDeProposta as ObjOrdem;

class PropostaOrcamento extends BaseModel
{

  public function insert(ObjProposta $proposta) {
    try {
      $this->pdo->beginTransaction();
      
      $queryOrc = "INSERT INTO propostadeorcamento(id_orcamento, id_fornecedor, aberto) VALUES(?, ?, ?)";
      $sqlOrc = $this->pdo->prepare($queryOrc);
      $sqlOrc->execute(array(
        $proposta->getIdOrcamento(),
        $proposta->getIdFornecedor(),
        $proposta->getAberto()
      ));

      $id_pro_orc = $this->pdo->lastInsertId();

      $queryOrdem = "INSERT INTO ordensdeproposta(id_prop_orc, id_ord_orc, valor) VALUES(?, ?, ?)";
      $sqlOrdem = $this->pdo->prepare($queryOrdem);

      foreach ($proposta->getOrdens() as $proposta) {
        $sqlOrdem->execute(array(
          $id_pro_orc,
          $proposta->getIdOrdOrc(),
          $proposta->getValor()
        ));
      }

      $this->pdo->commit();

      return $id_pro_orc;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function update(ObjProposta $proposta) {
    try {
      $this->pdo->beginTransaction();

      $queryOrdem = "UPDATE ordensdeproposta
                     SET valor = :valor
                     WHERE id = :id";
      $sqlOrdem = $this->pdo->prepare($queryOrdem);

      foreach ($proposta->getOrdens() as $proposta) {
        $sqlOrdem->bindValue(':id', $proposta->getId());
        $sqlOrdem->bindValue(':valor', $proposta->getValor());
        $sqlOrdem->execute();
      }

      $this->pdo->commit();

      return 1;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function aprovar($orcamentoId, $propostaId) {
    try {
      $this->pdo->beginTransaction();

      $query = "UPDATE orcamento
                SET vigencia_fim = DATE_SUB(now(), INTERVAL 1 MINUTE)
                WHERE id = ?";
      $sql = $this->pdo->prepare($query);
      $sql->execute([ $orcamentoId ]);

      $query = "UPDATE propostadeorcamento
                SET aceita = 1
                WHERE id = ?";
      $sql = $this->pdo->prepare($query);
      $sql->execute([ $propostaId ]);

      $this->pdo->commit();

      return 1;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
}
