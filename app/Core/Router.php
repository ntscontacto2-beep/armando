<?php
namespace App\Core;

class Router {
  private array $routes = [];

  public function get(string $pattern, $handler) { $this->map('GET', $pattern, $handler); }
  public function post(string $pattern, $handler) { $this->map('POST', $pattern, $handler); }

  private function map(string $method, string $pattern, $handler) {
    $pattern = '#^' . preg_replace('#\{([\w]+)\}#', '(?P<$1>[\w-]+)', $pattern) . '$#';
    $this->routes[] = ['method'=>$method,'pattern'=>$pattern,'handler'=>$handler];
  }

  public function dispatch(string $method, string $uri) {
    $path = parse_url($uri, PHP_URL_PATH);
    foreach ($this->routes as $r) {
      if ($r['method'] !== $method) continue;
      if (preg_match($r['pattern'], $path, $matches)) {
        $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
        $handler = $r['handler'];
        if (is_array($handler)) {
          [$class, $action] = $handler;
          $controller = new $class;
          return call_user_func_array([$controller, $action], $params);
        }
        return call_user_func_array($handler, $params);
      }
    }
    http_response_code(404);
    echo "404 - No encontrado";
  }
}
