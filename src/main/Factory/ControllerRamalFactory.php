<?php

namespace App\Main\Factory;

use App\Application\ControllerRamal;
use App\Domain\Usecase\HandleRamal;
use App\Domain\Usecase\LoadAllRamal;
use App\Domain\Usecase\SaveRamal;

class ControllerRamalFactory
{
  /**
   * @param string $dirFila
   * @param string $dirRamal
   */

  final public static function factory($dirFila, $dirRamal)
  {
    $ramal = new HandleRamal();
    $mySqlRamalDb = MySqlRamalFactory::factory();
    $save = new SaveRamal($mySqlRamalDb);
    $loadAll = new LoadAllRamal($mySqlRamalDb);

    $controller = new ControllerRamal($dirFila, $dirRamal, $ramal, $save, $loadAll);
    return $controller->perform();
  }
}
