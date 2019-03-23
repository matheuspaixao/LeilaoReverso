<?php

namespace App\Models;

use Core\BaseModel;
use PDO;
use PDOException;
use Src\Classes\Produto as ObjProduto;

class Produto extends BaseModel {
  // Ja existe um atributo $pdo fazendo conexão com o BD na classe BaseModel, use-o

  public function getProducts($search = null) {
    try {
      $query = "SELECT p.*, und.unidade as und_medida 
                FROM produto p
                INNER JOIN undMedida und
                  on p.id_und_medida = und.id";

      if (isset($search))
        $query .= " WHERE nome like '%:nome%' ORDER BY nome";
      else
        $query .= " ORDER BY nome";

      $sql = $this->pdo->prepare($query);
      
      if (isset($search))
        $sql->bindValue(':nome', $search);
      
      $sql->execute();

      return $sql->fetchAll();
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function getProductById($id) {
    try {
      $query = "SELECT * FROM produto WHERE id = :id";
      $sql = $this->pdo->prepare($query);
      $sql->bindValue(':id', $id);      
      $sql->execute();

      return $sql->fetchAll()[0];
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function insert(ObjProduto $produto) {
    try {
      $query = "INSERT INTO produto(nome, descricao, id_und_medida, id_usr_cad) 
                VALUES(:nome, :descricao, :id_und_medida, :id_usr_cad)";
      $sql = $this->pdo->prepare($query);      
      $sql->bindValue(':nome', $produto->nome);
      $sql->bindValue(':descricao', $produto->descricao);
      $sql->bindValue(':id_und_medida', $produto->id_und_medida);
      $sql->bindValue(':id_usr_cad', $produto->id_usr_cad);      
      $sql->execute();
      
      return $this->pdo->lastInsertId();
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function update(ObjProduto $produto) {
    try {
      $query = "UPDATE produto 
                SET nome = :nome,
                    descricao = :descricao,
                    id_und_medida = :id_und_medida,
                    id_usr_alter = :id_usr_alter,
                    ultima_alter = now()
                WHERE id = :id";
      $sql = $this->pdo->prepare($query);  
      $sql->bindValue(':id', $produto->id);
      $sql->bindValue(':nome', $produto->nome);
      $sql->bindValue(':descricao', $produto->descricao);
      $sql->bindValue(':id_und_medida', $produto->id_und_medida);
      $sql->bindValue(':id_usr_alter', $produto->id_usr_alter);
      $sql->execute();
      
      return true;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function delete($id) {
    try {
      $query = "DELETE FROM produto WHERE id = :id" ;
      $sql = $this->pdo->prepare($query);      
      $sql->bindValue(':id', $id);
      $sql->execute();
      
      return true;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
}