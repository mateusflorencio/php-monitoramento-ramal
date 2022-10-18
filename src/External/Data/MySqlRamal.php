<?php

namespace App\External\Data;

use App\Domain\Usecase\Contracts\RamalDatabase;

class MySqlRamal implements RamalDatabase
{

  public function execute($query, $params = [])
  {
    $statement = Database::$connection->prepare($query);
    $statement->execute($params);
    return $statement;
  }

  public function save($ramal)
  {
    $fields = array_keys($ramal);
    $binds = array_pad([], count($ramal), '?');

    $query = 'REPLACE INTO ramais (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';
    $this->execute($query, array_values($ramal));
  }
}
