<?php

namespace App\Domain\Entities;

class Ramal
{
  private $name;
  private $ramal;
  private $online;
  private $status;

  public function __construct($name, $ramal, $online, $status)
  {
    $this->name = $name;
    $this->ramal = $ramal;
    $this->online = $online;
    $this->status = $status;
  }
}
