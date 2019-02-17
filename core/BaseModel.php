<?php

namespace Core;

use PDO;

abstract class BaseModel {

  protected $pdo;

  public function __construct(PDO $pdo) {
    $this->pdo = $pdo;
  }
}