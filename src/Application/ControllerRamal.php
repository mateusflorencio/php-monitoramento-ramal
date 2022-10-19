<?php

namespace App\Application;

use App\Domain\Usecase\Contracts\HandleRamalInterface;
use App\Domain\Usecase\Contracts\LoadAllRamalInterface;
use App\Domain\Usecase\Contracts\SaveRamalInterface;

class ControllerRamal
{
  private $dirRamal;
  private $dirFila;
  private $handleDir;
  private $save;
  private $loadAll;

  public function __construct($dirFila, $dirRamal, HandleRamalInterface $handleDir, SaveRamalInterface $save, LoadAllRamalInterface $loadAll)
  {
    $this->handleDir = $handleDir;
    $this->save = $save;
    $this->dirRamal = $dirRamal;
    $this->dirFila = $dirFila;
    $this->loadAll = $loadAll;
  }

  public function perform()
  {
    $statusRamais = $this->handleDir->handle($this->dirFila, $this->dirRamal);
    if ($statusRamais) {
      foreach ($statusRamais as $ramal) {
        $this->save->save($ramal, 'ramais');
      }
    }
    return $this->loadAll->loadAll();
  }
}
