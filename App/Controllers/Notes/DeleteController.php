<?php

namespace App\Controllers\Notes;

use App\Models\Note;
use Core\Database;
use Core\Validation;

class DeleteController {
  public function __invoke() {
    $validation = Validation::validate([
      'id' => ['required']
    ], request()->all());

    if ($validation->notValid()) {
      return redirect('/notes?id=' . request()->post('id'));
    }

    Note::delete(request()->post('id'));

    flash()->push('message', 'Registro deletado com sucesso!!');

    return redirect('/notes');
  }
}