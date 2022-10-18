<?php

namespace App\Domain\Usecase;

use App\Domain\Usecase\Contracts\FindRamalInterface;
use App\Domain\Usecase\Contracts\RamalDatabase;
use App\Domain\Usecase\Contracts\SaveRamalInterface;

class SaveRamal implements SaveRamalInterface
{
  private $db;

  public function __construct(RamalDatabase $db)
  {
    $this->db = $db;
  }

  public function save($ramal)
  {
    $ar = array(
      'ramal' => $ramal->getRamal(),
      'numero' => $ramal->getNome(),
      'online' => $ramal->getOnline() ? 1 : 0,
      'status' => $ramal->getStatus(),
      'historico' => 0,
      'agente' => 'nhono',
    );
    $this->db->save($ar);
  }
}
