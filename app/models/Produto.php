<?php

namespace App\Models;

use Core\BaseModel;
use PDO;
use PDOException;
use Src\Classes\Produto as Product;

class Produto extends BaseModel {
  // Ja existe um atributo $pdo fazendo conexão com o BD na classe BaseModel, use-o

  public function getProducts($search = null) {
    try {
      if (isset($search))
        $query = "SELECT * FROM produto WHERE nome like '%:login%'";
      else
        $query = "SELECT * FROM produto";

      $sql = $this->pdo->prepare($query);
      
      if (isset($search))
        $sql->bindValue(':login', $login);
      
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

  public function insert(Product $produto) {
    try {
      $query = "INSERT INTO produto(nome, descricao, und_medida, id_usr_cad) 
                VALUES(:nome, :descricao, :und_medida, :id_usr_cad)";
      $sql = $this->pdo->prepare($query);      
      $sql->bindValue(':nome', $produto->nome);
      $sql->bindValue(':descricao', $produto->descricao);
      $sql->bindValue(':und_medida', $produto->und_medida);
      $sql->bindValue(':id_usr_cad', $produto->id_usr_cad);      
      $sql->execute();
      
      return $this->pdo->lastInsertId();
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function update(Product $produto) {
    try {
      $query = "UPDATE produto 
                SET nome = :nome,
                    descricao = :descricao,
                    und_medida = :und_medida,
                    id_usr_alter = :id_usr_alter,
                    ultima_alter = now()
                WHERE id = :id";
      $sql = $this->pdo->prepare($query);  
      $sql->bindValue(':id', $produto->id);
      $sql->bindValue(':nome', $produto->nome);
      $sql->bindValue(':descricao', $produto->descricao);
      $sql->bindValue(':und_medida', $produto->und_medida);
      $sql->bindValue(':id_usr_alter', $produto->id_usr_alter);
      $sql->execute();
      
      return true;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function delete($produtoId) {
    try {
      $query = "DELETE FROM produto WHERE id = :produtoId";
      $sql = $this->pdo->prepare($query);      
      $sql->bindValue(':produtoId', $produtoId);
      $sql->execute();
      
      return true;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
}