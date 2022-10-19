<?php

namespace App\Domain\Usecase;

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
    $save = array(
      'ramal' => $ramal->getRamal(),
      'username' => $ramal->getUserName(),
      'status' => $ramal->getStatus(),
      'agente' => $ramal->getAgente(),
      'historico' => $ramal->getHistorico(),
    );
    $this->db->save($save);
  }
}
