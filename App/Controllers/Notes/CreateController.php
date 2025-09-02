<?php

namespace App\Controllers\Notes;

class CreateController {
  public function index() {
    return view('notes/create', [
      'user' => auth()
    ]);
  }

  public function store() {
    dd($_POST);
  }
}