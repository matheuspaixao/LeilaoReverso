<?php

namespace App\Models;

use Core\BaseModel;
use PDO;
use PDOException;

class Login extends BaseModel 
{
  // Ja existe um atributo $pdo fazendo conexão com o BD na classe BaseModel, use-o

  public function getUserByLogin($login) {
    try {
      $query = "SELECT u.*, t.nivel_acesso
                FROM usuario u
                INNER JOIN tipoUsuario t
                  ON u.id_tipo_usuario = t.id
                WHERE login = :login";
      $sql = $this->pdo->prepare($query);
      $sql->bindValue(':login', $login);
      $sql->execute();
      
      return $sql->fetchAll()[0];
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function getUsersLogin() {
    try {
      $query = "SELECT login FROM usuario";
      $sql = $this->pdo->prepare($query);
      $sql->execute();
      
      return $sql->fetchAll();
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function insertFornecedora($usuario) {
    try {
      $tipo_usuario = self::getTipoUsuario($usuario->tipo_usuario);
      $usuario->id_tipo_usuario = $tipo_usuario->id;
      
      $query = "INSERT INTO 
                  usuario(login, senha, nome, email, telefone, id_tipo_usuario, num_documento, 
                          tipo_documento, endereco, numero, cidade, UF, cep) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $sql = $this->pdo->prepare($query);
      $sql->execute([ $usuario->login, $usuario->senha, $usuario->nome, $usuario->email,
                      $usuario->telefone, $usuario->id_tipo_usuario, $usuario->num_documento,
                      $usuario->tipo_documento, $usuario->endereco, $usuario->numero,
                      $usuario->cidade, $usuario->UF, $usuario->cep
      ]);
      
      return $this->pdo->lastInsertId();
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