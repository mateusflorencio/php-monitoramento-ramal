<?php

namespace App\Domain\Usecase\Contracts;

interface RamalDatabase

/**
 * @param Ramal $ramal
 * @param string $table
 */
{
  public function insert($ramal, $table);
}
