<?php
namespace App\Core;

class Controller {
  protected function view(string $view, array $data = [], string $layout = 'layouts/main') {
    $v = new View($layout);
    $v->render($view, $data);
  }
}
