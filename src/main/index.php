<?php
header("Content-type: application/json; charset=utf-8");

require_once '../../vendor/autoload.php';

use App\External\Data\Database;
use App\Main\Factory\ControllerRamalFactory;

Database::setConnection();

$ramais = file('../../lib/ramais');
$filas = file('../../lib/filas');

$statusRamais = ControllerRamalFactory::factory($filas, $ramais);

echo json_encode($statusRamais);
