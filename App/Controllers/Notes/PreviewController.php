<?php

namespace App\Controllers\Notes;

class PreviewController {
  public function show() {
    session()->set('show', true);

    return redirect('/notes');
  }

  public function hide() {
    session()->forget('show');

    return redirect('/notes');
  }
}