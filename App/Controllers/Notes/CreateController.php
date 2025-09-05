<?php

namespace App\Controllers\Notes;

use Core\Database;
use Core\Validation;

class CreateController {
  public function index() {
    return view('notes/create');
  }

  public function store() {
    $validation = Validation::validate([
      'title' => ['required', 'min:3', 'max:255'],
      'note' => ['required']
    ], $_POST);

    if ($validation->notValid()) {
      return view('notes/create');
    }

    $database = new Database(config('database'));

    $database->query(
      query: "insert into notes (user_id, title, note, created_at, updated_at)
        values (
          :user_id,
          :title,
          :note,
          :created_at,
          :updated_at
        )",
      params: [
        'user_id' => auth()->id,
        'title' => $_POST['title'],
        'note' => $_POST['note'],
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ]
    );

    flash()->push('message', 'Nota criada com sucesso!');
    return redirect('/notes');
  }
}