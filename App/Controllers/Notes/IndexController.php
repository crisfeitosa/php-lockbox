<?php 

namespace App\Controllers\Notes;

class IndexController {
  public function __invoke() {
    if (! auth()) {
      return redirect('/login');
    }

    return view('notes', [
      'user' => auth()
    ]);
  }
}