<?php

<<<<<<< HEAD
namespace App\Filament\Pages\Auth;
=======
namespace App\Filament\Candidate\Pages;
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6

use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'logout';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->action(function () {
            Auth::logout();
            Session::invalidate();
            Session::regenerateToken();

            return redirect()->route('home');
        });
    }
}