<?php 

namespace App\Controllers\Notes;

use App\Models\Note;

class IndexController {
  public function __invoke() {
    $notes = Note::all();

    $id = isset($_GET['id']) ? $_GET['id'] : $notes[0]->id;

    $filter = array_filter($notes, fn($n) => $n->id == $id);

    $noteSelected = array_pop($filter);

    return view('notes', [
      'notes' => $notes,
      'noteSelected' => $noteSelected
    ]);
  }
}