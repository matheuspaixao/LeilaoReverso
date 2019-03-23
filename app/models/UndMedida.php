<?php

namespace App\Models;

use Core\BaseModel;
use PDO;
use PDOException;

class UndMedida extends BaseModel {
    
  public function getUndMedidas($idUndAtiva = null) {
    try {
      if (isset($idUndAtiva)) {
        $query = "SELECT 
                    *, 
                    CASE 
                      WHEN id = :idUndAtiva 
                      THEN 1 
                      ELSE 0 
                    END AS ativo
                  FROM undMedida
                  ORDER BY unidade";
      }
      else {
        $query = "SELECT *, 0 AS ativo FROM undMedida ORDER BY unidade";
      }        

      $sql = $this->pdo->prepare($query);
      
      if (isset($idUndAtiva))
        $sql->bindValue(':idUndAtiva', $idUndAtiva);
      
      $sql->execute();

      return $sql->fetchAll();
    } catch (PDOException $e) {
      return $e->getMessage();
    }
  }
}