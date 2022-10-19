<?php

namespace App\Domain\Entities;

class Ramal
{
  public $nome;
  public $ramal;
  public $online;
  public $status;
  public $historico;

  public function __construct($ramal, $userName, $status, $agente, $historico)
  {
    $this->ramal = $ramal;
    $this->userName = $userName;
    $this->status = $status;
    $this->agente = $agente;
    $this->historico = $historico;
  }

  public function getuserName()
  {
    return $this->userName;
  }

  public function getRamal()
  {
    return $this->ramal;
  }

  public function getStatus()
  {
    return $this->status;
  }

  public function getAgente()
  {
    return $this->agente;
  }

  public function getHistorico()
  {
    return $this->historico;
  }
}
