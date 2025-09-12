<?php

declare(strict_types = 1);

namespace App\Controllers\Notes;

use Core\Validation;

class PreviewController
{
    public function show()
    {
        $validation = Validation::validate([
            'password' => ['required'],
        ], request()->all());

        if ($validation->notValid()) {
            return view('notes/confirm');
        }

        if (! (password_verify(request()->post('password'), auth()->password))) {
            flash()->push('validations', ['password' => ['Senha incorreta!']]);

            return view('notes/confirm');
        }

        session()->set('show', true);

        return redirect('/notes');
    }

    public function hide()
    {
        session()->forget('show');

        return redirect('/notes');
    }

    public function confirm()
    {
        return view('/notes/confirm');
    }
}
