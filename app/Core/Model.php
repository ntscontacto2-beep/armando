<?php
namespace App\Core;
use PDO;

class Model {
  protected static PDO $db;

  public function __construct() { static::init(); }

  protected static function init(): void {
    if (!isset(static::$db)) {
      $cfg = config();
      $dsn = "mysql:host={$cfg['db']['host']};port={$cfg['db']['port']};dbname={$cfg['db']['name']};charset={$cfg['db']['charset']}";
      static::$db = new PDO($dsn, $cfg['db']['user'], $cfg['db']['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]);
    }
  }

  protected function db(): PDO { return static::$db; }
}
