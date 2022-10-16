<?php

namespace App\Domain\Entities;

class Ramal
{
  public $nome;
  public $ramal;
  public $online;
  public $status;
  public $agente;

  public function __construct($nome, $ramal, $online, $status, $agente)
  {
    $this->nome = $nome;
    $this->ramal = $ramal;
    $this->online = $online;
    $this->status = $status;
    $this->agente = $agente;
  }

  
}
