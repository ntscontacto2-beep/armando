<?php
function config(): array {
  static $cfg = null;
  if ($cfg === null) $cfg = require __DIR__ . '/../../config/config.php';
  return $cfg;
}

function base_url(string $path = ''): string {
  $cfg = config();
  return rtrim($cfg['app']['base_url'], '/') . '/' . ltrim($path, '/');
}

function e(?string $str): string {
  return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}
