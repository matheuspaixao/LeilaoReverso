<?php

namespace Core;

use PDO;
use PDOException;

class DataBase {

  public static function getDataBase() {
    $conf = include_once __DIR__ . "/../config.php";
    $db = $conf['database'];  

    try {
      $pdo = new PDO("mysql:host={$db['host']};dbname={$db['name']};charset={$db['charset']}", $db['user'], $db['pass']);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES {$db['charset']} COLLATE {$db['collation']}");
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

      return $pdo;
    } catch (PDOException $e) {
      echo "Erro: " . $e->getMessage();
    }
  }
}