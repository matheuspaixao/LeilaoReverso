<?php

namespace App\Models;

use Core\BaseModel;
use PDO;
use PDOException;

class Fornecedora extends BaseModel {

  public function getFornecedoras() {
    try {
      $query = "SELECT 
                  u.*,
                  DATE_FORMAT(u.criado_em, '%d/%m/%Y %H:%i') AS criado_em_formatado,
                  IF (t.id = 4, false, true) AS ativo
                FROM usuario u
                INNER JOIN tipoUsuario t
                  on u.id_tipo_usuario = t.id
                WHERE t.nome like 'Fornecedor%'";
      $sql = $this->pdo->prepare($query);      
      $sql->execute();

      return $sql->fetchAll();
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function aprovarFornecedora($id) {
    try {
      $id_tipo_usuario = self::getTipoUsuario('Fornecedor Ativo');

      $query = "UPDATE usuario 
                SET id_tipo_usuario = ?
                WHERE id = ?";
      $sql = $this->pdo->prepare($query);      
      $sql->execute([ $id_tipo_usuario->id, $id ]);

      return $id;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  private function getTipoUsuario($tipo_usuario) {
    try {
      $query = "SELECT * FROM tipoUsuario WHERE nome = ?";
      $sql = $this->pdo->prepare($query);
      $sql->execute([ $tipo_usuario ]);
      
      return $sql->fetchAll()[0];
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
}