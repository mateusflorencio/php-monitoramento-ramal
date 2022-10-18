<?php

namespace App\Domain\Usecase\Contracts;

interface RamalDatabase
{

  /**
   * @param array[Ramal] $ramal
   * @param string $table
   */
  public function save($ramal);
}
