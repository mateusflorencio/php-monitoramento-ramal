<?php

namespace App\Domain\Usecase;

use App\Domain\Entities\Ramal;
use App\Domain\Usecase\Contracts\HandleRamalInterface;

class HandleRamal implements HandleRamalInterface
{
  private array $statusFilas;
  private array $statusRamais;

  public function handle($dirFila, $dirRamais)
  {
    $this->handleFilas($dirFila);
    $this->handleRamais($dirRamais);

    if ($this->statusFilas && $this->statusRamais) {
      return $this->statusRamais;
    }
  }

  private function handleFilas($dirFila)
  {
    foreach ($dirFila as $linhas) {
      if (strstr($linhas, 'SIP/')) {
        if (strstr($linhas, '(Ring)')) {
          $this->statusFilas[$this->getRamal($linhas)] = array('status' => 'chamando');
        } elseif (strstr($linhas, '(In use)')) {
          $this->statusFilas[$this->getRamal($linhas)] = array('status' => 'ocupado');
        } elseif (strstr($linhas, '(Not in use)')) {
          $this->statusFilas[$this->getRamal($linhas)] = array('status' => 'disponivel');
        } elseif (strstr($linhas, '(Unavailable)')) {
          $this->statusFilas[$this->getRamal($linhas)] = array('status' => 'indisponivel');
        }
      }
    }
  }

  private function  handleRamais($dirRamais)
  {
    foreach ($dirRamais as $linhas) {
      $linha = array_filter(explode(' ', $linhas));
      $arr = array_values($linha);
      if ((trim($arr[0]) !== "Name/username") && (trim($arr[1]) !== "sip")) {
        list($name, $username) = explode('/', $arr[0]);
        $this->statusRamais[$name] = new Ramal(
          $name,
          $username,
          in_array('OK', $arr) ? true : false,
          $this->statusFilas[$name]['status']

        );
      }
    }
  }

  private function getRamal($linhas)
  {
    $linha = explode(' ', trim($linhas));
    $explode = explode('/', $linha[0]);
    return  $explode[1];
  }
}
