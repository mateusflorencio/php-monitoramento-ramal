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

  public function insert($values, $table)
  {
    $fields = array_keys($values);
    $binds = array_pad([], count($values), '?');

    $query = 'INSERT INTO ' . $table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';
    $this->execute($query, array_values($values));
  }
}
