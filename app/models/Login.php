<?php

namespace App\Models;

use Core\BaseModel;
use PDO;
use PDOException;

class Login extends BaseModel 
{
  // Ja existe um atributo $pdo fazendo conexão com o BD na classe BaseModel, use-o

  public function getUserById($login) {
    try {
      $query = "SELECT * FROM usuario WHERE login = :login";
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
}