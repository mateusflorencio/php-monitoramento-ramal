<?php

namespace App\External\Data;

use \PDO;

class Database
{

  public static $connection;
  const HOST = 'localhost';
  const NAME = 'testedev';
  const USER = 'root';
  const PASS = 'root';

  final public static function setConnection()
  {
    self::$connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
    self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
}
