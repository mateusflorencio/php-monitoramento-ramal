<?php

namespace App\Domain\Usecase\Contracts;

interface LoadAllRamalInterface
{

  /**
   * @return array[Ramal]
   */
  public function loadAll();
}