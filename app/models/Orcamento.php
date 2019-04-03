<?php

namespace App\Models;

use Core\BaseModel;
use PDO;
use PDOException;
use Src\Classes\Orcamento as ObjOrcamento;
use Src\Classes\OrdemDeOrcamento as ObjOrdem;

class Orcamento extends BaseModel
{
  // Ja existe um atributo $pdo fazendo conexão com o BD na classe BaseModel, use-o

  public function getOrcamentos() {
    try {
      $query = "SELECT O.id,
                       CASE
                         WHEN LENGTH(O.nome) > 20
                         THEN CONCAT(LEFT(O.nome, 20), '...')
                         ELSE O.nome
                       END AS nome,
                       O.aberto,
                       DATE_FORMAT(O.vigencia_inicio, '%d/%m/%Y %H:%i') AS vigencia_inicio,
                       DATE_FORMAT(O.vigencia_fim, '%d/%m/%Y %H:%i') AS vigencia_fim,
                       O.id_usr_cad,
                       O.id_usr_alter,
                       O.criado_em,
                       O.ultima_alter,
                       COUNT(Ordem.id_produto) AS qtdProdutos,
                       CASE
                         WHEN O.vigencia_fim < CURRENT_TIMESTAMP()
                         THEN 0
                         ELSE 1
                       END AS ativo
                FROM orcamento O
                INNER JOIN ordensdeorcamento Ordem
                  ON O.id = Ordem.id_orcamento
                GROUP BY  O.id,
                          O.nome,
                          O.aberto,
                          O.vigencia_inicio,
                          O.vigencia_fim,
                          O.id_usr_cad,
                          O.id_usr_alter,
                          O.criado_em,
                          O.ultima_alter";

      $sql = $this->pdo->prepare($query);
      $sql->execute();

      return $sql->fetchAll();
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function getOrcamentoById($id) {
    try {
      $query = "SELECT O.id AS idOrc,
                       O.nome AS nomeOrc,
                       O.aberto AS abertoOrc,
                       Ordem.id AS idOrdem,
                       P.nome AS nomeProd,
                       und.unidade AS undProd,
                       Ordem.quantidade AS qtdProd
                FROM orcamento O
                INNER JOIN ordensdeorcamento Ordem
                  ON O.id = Ordem.id_orcamento
                INNER JOIN produto P
                  ON Ordem.id_produto = P.id
                INNER JOIN undmedida und
                  ON P.id_und_medida = und.id
                WHERE O.id = :id";
      $sql = $this->pdo->prepare($query);
      $sql->bindValue(':id', $id);
      $sql->execute();

      return $sql->fetchAll();
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function getFullOrcamentoById($id) {
    try {
      $query = "SELECT O.id AS idOrc,
                       O.nome AS nomeOrc,
                       O.aberto AS orcAberto,
                       ordemO.id AS idOrdOrc,
                       P.id AS idProd,
                       P.nome AS nomeProd,
                       und.unidade AS undProd,
                       ordemO.quantidade AS qtdProd,
                       u.nome AS fornecedora,
                       ordemP.id AS idOrdProp,
                       ordemP.valor,
                       ordemP.aceita
                FROM orcamento O
                INNER JOIN ordensdeorcamento ordemO
                  ON O.id = ordemO.id_orcamento
                INNER JOIN produto P
                  ON ordemO.id_produto = P.id
                INNER JOIN undmedida und
                  ON P.id_und_medida = und.id
                LEFT JOIN propostadeorcamento prop
                  ON ordemO.id = prop.id_orcamento
                LEFT JOIN ordensdeproposta ordemP
                  ON prop.id = ordemP.id_prop_orc
                  AND ordemO.id = ordemP.id_ord_orc
                LEFT JOIN usuario u
                  ON prop.id_fornecedor = u.id
                WHERE O.id = ?";
      $sql = $this->pdo->prepare($query);
      $sql->execute([ $id ]);

      return $sql->fetchAll();
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function insert(ObjOrcamento $orcamento) {
    try {
      $this->pdo->beginTransaction();

      // inserir primeiro o orcamento
      $queryOrc = "INSERT INTO orcamento(nome, aberto, vigencia_inicio, vigencia_fim, id_usr_cad) VALUES(?, ?, ?, ?, ?)";
      $sqlOrc = $this->pdo->prepare($queryOrc);
      $sqlOrc->execute(array(
        $orcamento->getNome(),
        $orcamento->getAberto(),
        $orcamento->getVigenciaInicio(),
        $orcamento->getVigenciaFim(),
        $orcamento->getIdUsrCad()
      ));

      $idOrcamento = $this->pdo->lastInsertId();

      $queryOrdem = "INSERT INTO ordensdeorcamento(quantidade, id_orcamento, id_produto)
                     VALUES(?, ?, ?)";
      $sqlOrdem = $this->pdo->prepare($queryOrdem);

      foreach ($orcamento->getOrdens() as $ordem) {
        $sqlOrdem->execute(array(
          $ordem->getQtd(),
          $idOrcamento,
          $ordem->getProduto()->getId()
        ));
      }

      $this->pdo->commit();

      return $this->pdo->lastInsertId();
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function update(ObjOrcamento $orcamento) {
    try {
      $query = "UPDATE orcamento
                SET nome = :nome,
                    descricao = :descricao,
                    und_medida = :und_medida,
                    id_usr_alter = :id_usr_alter,
                    ultima_alter = now()
                WHERE id = :id";
      $sql = $this->pdo->prepare($query);
      $sql->bindValue(':id', $orcamento->id);
      $sql->bindValue(':nome', $orcamento->nome);
      $sql->bindValue(':descricao', $orcamento->descricao);
      $sql->bindValue(':und_medida', $orcamento->und_medida);
      $sql->bindValue(':id_usr_alter', $orcamento->id_usr_alter);
      $sql->execute();

      return true;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function delete($id) {
    try {
      $query = "DELETE FROM orcamento WHERE id = :id";
      $sql = $this->pdo->prepare($query);
      $sql->bindValue(':id', $orcamentoId);
      $sql->execute();

      return true;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
}
