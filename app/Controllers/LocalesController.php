<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Local;

class LocalesController extends Controller {
  public function index() {
    $q = trim($_GET['q'] ?? '');
    $modelo = new Local();
    $locales = $q ? $modelo->buscar($q) : $modelo->listar();
    $this->view('locales/index', ['locales' => $locales, 'title'=>'Locales', 'q'=>$q]);
  }

  public function show(string $slug) {
    $modelo = new Local();
    $local = $modelo->porSlug($slug);
    $this->view('locales/show', ['local'=>$local, 'title'=> $local ? $local['nombre'] : 'No encontrado']);
  }
}
