<?php

namespace App\Models;

use Core\BaseModel;
use PDO;
use PDOException;

class Usuario extends BaseModel
{
  
  public function getUsers() {
    try {
      $query = "SELECT u.*
                FROM usuario u
                INNER JOIN tipousuario t
                  ON u.id_tipo_usuario = t.id
                WHERE t.nivel_acesso = 5";
      $sql = $this->pdo->prepare($query);
      $sql->execute();

      return $sql->fetchAll();
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function getUserByLogin($login) {
    try {
      $query = "SELECT u.*, t.nivel_acesso
                FROM usuario u
                INNER JOIN tipousuario t
                  ON u.id_tipo_usuario = t.id
                WHERE login = :login";
      $sql = $this->pdo->prepare($query);
      $sql->bindValue(':login', $login);
      $sql->execute();

      return $sql->fetch();
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function getUserById($id) {
    try {
      $query = "SELECT u.*, t.nivel_acesso
                FROM usuario u
                INNER JOIN tipousuario t
                  ON u.id_tipo_usuario = t.id
                WHERE u.id = :id";
      $sql = $this->pdo->prepare($query);
      $sql->bindValue(':id', $id);
      $sql->execute();

      return $sql->fetch();
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

  public function insert($usuario) {
    try {
      $tipo_usuario = self::getTipoUsuario($usuario->tipo_usuario);
      $usuario->id_tipo_usuario = $tipo_usuario->id;

      $query = "INSERT INTO
                  usuario(login, senha, nome, email, telefone, id_tipo_usuario, num_documento,
                          tipo_documento, endereco, numero, cidade, UF, cep)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $sql = $this->pdo->prepare($query);
      $sql->execute([ strtolower($usuario->login), $usuario->senha, $usuario->nome, $usuario->email,
                      $usuario->telefone, $usuario->id_tipo_usuario, $usuario->num_documento,
                      $usuario->tipo_documento, $usuario->endereco, $usuario->numero,
                      $usuario->cidade, $usuario->UF, $usuario->cep
      ]);

      return $this->pdo->lastInsertId();
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function update($id, $usuario) {
    try {
      $query = "UPDATE usuario
                SET nome = :nome,
                    email = :email,
                    telefone = :telefone,
                    num_documento = :num_documento,
                    tipo_documento = :tipo_documento,
                    endereco = :endereco,
                    numero = :numero,
                    cidade = :cidade,
                    UF = :UF,
                    cep = :cep
                WHERE id = :id";
      $sql = $this->pdo->prepare($query);
      $sql->bindValue(':id', $id);
      $sql->bindValue(':nome', $usuario->nome);
      $sql->bindValue(':email', $usuario->email);
      $sql->bindValue(':telefone', $usuario->telefone);
      $sql->bindValue(':num_documento', $usuario->num_documento);
      $sql->bindValue(':tipo_documento', $usuario->tipo_documento);
      $sql->bindValue(':endereco', $usuario->endereco);
      $sql->bindValue(':numero', $usuario->numero);
      $sql->bindValue(':cidade', $usuario->cidade);
      $sql->bindValue(':UF', $usuario->UF);
      $sql->bindValue(':cep', $usuario->cep);
      $sql->execute();

      return 1;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  public function updateLastLogin($id) {
    try {
      $query = "UPDATE usuario
                SET ultimo_acesso = now()
                WHERE id = :id";
      $sql = $this->pdo->prepare($query);
      $sql->bindValue(':id', $id);
      $sql->execute();

      return 1;
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }

  private function getTipoUsuario($tipo_usuario) {
    try {
      $query = "SELECT * FROM tipousuario WHERE nome = ?";
      $sql = $this->pdo->prepare($query);
      $sql->execute([ $tipo_usuario ]);

      return $sql->fetchAll()[0];
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
}
