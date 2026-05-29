<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Ruta;

class RutasController extends Controller {
  public function index() {
    $r = new Ruta();
    $rutas = $r->listar();
    $this->view('rutas/index', ['rutas'=>$rutas, 'title'=>'Rutas']);
  }
}
