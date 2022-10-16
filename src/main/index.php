<?php
header("Content-type: application/json; charset=utf-8");

require_once '../../vendor/autoload.php';

use App\Domain\Usecase\LoadFiles;

$ramais = file('../../lib/ramais');
$filas = file('../../lib/filas');

$loadFiles = new LoadFiles();
$loadFiles->handle($filas, $ramais);
$statusRamais = $loadFiles->getStatusRamal();

echo json_encode($statusRamais);
