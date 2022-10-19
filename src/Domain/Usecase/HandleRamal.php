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
        $this->statusFilas[$this->getRamal($linhas) . 'agente'] = array('nome' => $this->getNome($linhas));
        $this->statusFilas[$this->getRamal($linhas) . 'historico'] = array('historico' => $this->getHistorico($linhas));
      }
    }
  }

  private function  handleRamais($dirRamais)
  {
    foreach ($dirRamais as $linhas) {
      $linha = array_filter(explode(' ', $linhas));
      $arr = array_values($linha);
      if ((trim($arr[0]) !== "Name/username") && (trim($arr[1]) !== "sip")) {
        list($ramal, $username) = explode('/', $arr[0]);
        $this->statusRamais[$ramal] = new Ramal(
          $ramal,
          $username,
          $this->statusFilas[$ramal]['status'],
          $this->statusFilas[$ramal . 'agente']['nome'],
          $this->statusFilas[$ramal . 'historico']['historico']
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

  private function getNome($linhas)
  {
    $arr = explode(' ', trim($linhas));
    return  array_pop($arr);
  }

  /**
   * @param string $linhas
   * @return integer
   */

  private function getHistorico($linhas)
  {
    $arr = explode(' ', trim($linhas));
    $res = array_search('calls', $arr);
    return $arr[$res - 1] == 'no' ? 0 : (int)$arr[$res - 1];
  }
}
