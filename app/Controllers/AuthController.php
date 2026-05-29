<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Models\Vendedor;

class AuthController extends Controller {
  public function login() {
    $email = $_POST['email'] ?? '';
    $pass = $_POST['password'] ?? '';
    $v = new Vendedor();
    $user = $v->login($email, $pass);
    if ($user) {
      if (session_status() !== PHP_SESSION_ACTIVE) session_start();
      $_SESSION['user'] = ['id'=>$user['id'],'nombre'=>$user['nombre']];
      header('Location: ' . base_url());
      exit;
    }
    $this->view('home/index', ['login_error'=>'Credenciales inválidas', 'title'=>'Inicio']);
  }
  public function logout() {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    session_destroy();
    header('Location: ' . base_url());
    exit;
  }
}
