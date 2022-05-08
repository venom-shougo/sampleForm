<?php

class Database
{
  public static function connect()
  {
    try {
      $pdo = new PDO(
        DSN, DB_USER, DB_PASS,
        [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false
        ]
        );
        return $pdo;
    } catch (PDOEXception $e) {
      echo 'Connection Failed' . $e->getMessage();
      exit;
    }
  }
}