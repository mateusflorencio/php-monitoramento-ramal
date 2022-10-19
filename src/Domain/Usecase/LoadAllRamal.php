<?php

namespace App\Domain\Usecase;

use App\Domain\Usecase\Contracts\LoadAllRamalInterface;
use App\Domain\Usecase\Contracts\RamalDatabase;

class LoadAllRamal implements LoadAllRamalInterface
{
  private $db;
  public function __construct(RamalDatabase $db)
  {
    $this->db = $db;
  }

  public function loadAll()
  {
    $ramais = $this->db->loadAll();
    if ($ramais) {
      return $ramais;
    }
  }
}
