<?php
header("Content-type: application/json; charset=utf-8");

require_once '../../vendor/autoload.php';
use App\Domain\Entities\Ramal;

$ramais = file('../../lib/ramais');
$filas = file('../../lib/filas');

function getRamal($linhas)
{
    $linha = explode(' ', trim($linhas));
    $explode = explode('/', $linha[0]);
    return  $explode[1];
}
$status_ramais = array();
foreach ($filas as $linhas) {
    if (strstr($linhas, 'SIP/')) {
        if (strstr($linhas, '(Ring)')) {
            $status_ramais[getRamal($linhas)] = array('status' => 'chamando');
        }
        if (strstr($linhas, '(In use)')) {
            $status_ramais[getRamal($linhas)] = array('status' => 'ocupado');
        }
        if (strstr($linhas, '(Not in use)')) {
            $status_ramais[getRamal($linhas)] = array('status' => 'disponivel');
        }
        if (strstr($linhas, '(Unavailable)')) {
            $status_ramais[getRamal($linhas)] = array('status' => 'indisponivel');
        }
    }
}

$info_ramais = array();
foreach ($ramais as $linhas) {
    $linha = array_filter(explode(' ', $linhas));
    $arr = array_values($linha);
    if ((trim($arr[0]) !== "Name/username") && (trim($arr[1]) !== "sip")) {
        list($name, $username) = explode('/', $arr[0]);
        $info_ramais[$name] =
            new Ramal(
                $name,
                $username,
                in_array('OK', $arr) ? true : false,
                $status_ramais[$name]['status']

            );
    }
}

echo json_encode($info_ramais);
