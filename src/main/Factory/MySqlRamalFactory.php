<?php

namespace App\Main\Factory;

use App\External\Data\MySqlRamal;

class MySqlRamalFactory
{

  final public static function factory()
  {
    return new MySqlRamal();
  }
}
