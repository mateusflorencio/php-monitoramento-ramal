<?php

namespace App\Domain\Usecase;

use App\Domain\Entities\Ramal;

class LoadFiles
{
  private array $statusFilas;
  private array $statusRamais;

  public function handle($pathFilas, $pathRamais)
  {
    $this->handleFilas($pathFilas);
    $this->handleRamais($pathRamais);
  }

  private function handleFilas($pathFile)
  {
    foreach ($pathFile as $linhas) {
      if (strstr($linhas, 'SIP/')) {
        if (strstr($linhas, '(Ring)')) {
          $this->statusFilas[$this->getRamal($linhas)] = array('status' => 'chamando');
        }
        if (strstr($linhas, '(In use)')) {
          $this->statusFilas[$this->getRamal($linhas)] = array('status' => 'ocupado');
        }
        if (strstr($linhas, '(Not in use)')) {
          $this->statusFilas[$this->getRamal($linhas)] = array('status' => 'disponivel');
        }
        if (strstr($linhas, '(Unavailable)')) {
          $this->statusFilas[$this->getRamal($linhas)] = array('status' => 'indisponivel');
        }
      }
    }
  }

  private function  handleRamais($pathRamais)
  {
    foreach ($pathRamais as $linhas) {
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

  public function getStatusRamal()
  {
    return $this->statusRamais;
  }
}
