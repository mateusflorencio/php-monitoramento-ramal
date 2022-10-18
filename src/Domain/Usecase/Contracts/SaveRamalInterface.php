<?php

namespace App\Domain\Usecase\Contracts;

interface SaveRamalInterface
{

  /**
   * @param Ramal $ramal
   * @param string $table
   */
  public function save($ramal);
}
