<?php

namespace Model;

use mysqli;

class Database
{
  private static $connection;

  public static function getConnection()
  {
    if (self::$connection === null) {
      $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
      $dotenv->load();

      $host = $_ENV['DB_HOST'];
      $username = $_ENV['DB_USER'];
      $password = $_ENV['DB_PASS'];
      $database = $_ENV['DB_NAME'];

      self::$connection = new mysqli($host, $username, $password, $database);

      if (self::$connection->connect_error) {
        die("Connection failed: " . self::$connection->connect_error);
      }
    }
    return self::$connection;
  }

  public function close()
  {
    if (self::$connection !== null) {
      self::$connection->close();
    }
  }
}
