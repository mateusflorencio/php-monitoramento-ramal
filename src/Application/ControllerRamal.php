<?php

namespace App\Application;

use App\Domain\Usecase\Contracts\HandleRamalInterface;
use App\Domain\Usecase\Contracts\SaveRamalInterface;

class ControllerRamal
{
  private $dirRamal;
  private $dirFila;
  private $handleDir;
  private $save;

  public function __construct($dirFila, $dirRamal, HandleRamalInterface $handleDir, SaveRamalInterface $save)
  {
    $this->handleDir = $handleDir;
    $this->save = $save;
    $this->dirRamal = $dirRamal;
    $this->dirFila = $dirFila;
  }

  public function perform()
  {
    $statusRamais = $this->handleDir->handle($this->dirFila, $this->dirRamal);
    if ($statusRamais) {
      foreach ($statusRamais as $ramal) {
        $this->save->save($ramal, 'ramais');
      }
    }
    return $statusRamais;
  }
}
