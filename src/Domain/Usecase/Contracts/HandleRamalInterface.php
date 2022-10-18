<?php

namespace App\Domain\Usecase\Contracts;

interface HandleRamalInterface
{
  /** 
   * @param string $dirFila
   * @param string $dirRamal
   * @return array[Ramal] 
   */
  public function handle($dirFila, $dirRamal);
}
