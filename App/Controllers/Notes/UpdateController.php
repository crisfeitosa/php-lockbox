<?php

namespace App\Controllers\Notes;

use App\Models\Note;
use Core\Database;
use Core\Validation;

class UpdateController {
  public function __invoke() {
    $validation = Validation::validate([
      'title' => ['required', 'min:3', 'max:255'],
      'note' => ['required'],
      'id' => ['required']
    ], request()->all());

    if ($validation->notValid()) {
      return redirect('/notes?id=' . request()->post('id'));
    }

    Note::update(
      request()->post('id'),
      request()->post('title'),
      request()->post('note')
    );

    flash()->push('message', 'Registro atualizado com sucesso!!');

    return redirect('/notes?id=' . request()->post('id'));
  }
}