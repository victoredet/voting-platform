<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class Hooks extends Controller
{

    public function CheckLogin()
    {
        $user = Session::get('user');
        if (!$user) {
            return redirect('sign-in');
        }
        return true;
    }

}