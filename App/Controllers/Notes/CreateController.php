<?php

namespace App\Controllers\Notes;

class CreateController {
  public function index() {
    return view('notes/create');
  }

  public function store() {
    dd($_POST);
  }
}