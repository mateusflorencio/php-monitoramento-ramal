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
          $this->statusFilas[$this->getRamal($linhas)] = array(
            'status' => 'chamando',
            'agente' => $this->getAgente($linhas)
          );
        }
        if (strstr($linhas, '(In use)')) {
          $this->statusFilas[$this->getRamal($linhas)] = array(
            'status' => 'ocupado',
            'agente' => $this->getAgente($linhas)
          );
        }
        if (strstr($linhas, '(Not in use)')) {
          $this->statusFilas[$this->getRamal($linhas)] = array(
            'status' => 'disponivel',
            'agente' => $this->getAgente($linhas)
          );
        }
        if (strstr($linhas, '(Unavailable)')) {
          $this->statusFilas[$this->getRamal($linhas)] = array(
            'status' => 'indisponivel',
            'agente' => $this->getAgente($linhas)
          );
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
          $this->statusFilas[$name]['status'],
          $this->statusFilas[$name]['agente']

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

  private function getAgente($linhas)
  {
    $linha = explode(' ', trim($linhas));
    return  array_pop($linha);
  }

  public function getStatusRamal()
  {
    return $this->statusRamais;
  }
}
