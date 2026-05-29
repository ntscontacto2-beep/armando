<?php
namespace App\Controllers;

use App\Core\Controller;

class PagesController extends Controller {
    public function historia() {
        $this->view('pages/historia', [
            'title' => 'Historia del Tianguis de San Martín Texmelucan'
        ]);
    }
}
