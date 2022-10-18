<?php

namespace App\Domain\Entities;

class Ramal
{
  public $nome;
  public $ramal;
  public $online;
  public $status;

  public function __construct($nome, $ramal, $online, $status)
  {
    $this->nome = $nome;
    $this->ramal = $ramal;
    $this->online = $online;
    $this->status = $status;
  }

  public function getNome()
  {
    return $this->nome;
  }

  public function getRamal()
  {
    return $this->ramal;
  }

  public function getOnline()
  {
    return $this->online;
  }

  public function getStatus()
  {
    return $this->status;
  }
}
