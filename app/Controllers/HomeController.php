<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Local;

class HomeController extends Controller {
  public function index() {
    $local = new Local();
    $destacados = $local->getDestacados(6);
    $this->view('home/index', ['destacados' => $destacados, 'title' => 'Inicio']);
  }
}
