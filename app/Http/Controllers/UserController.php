<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Hooks;

class UserController extends Controller
{
    public function dashboardPage()
    {
        // [Hooks::class, 'checkLogin'];
        //get the resources for this page
        return view('dashboard.dashboard');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return User::find($id);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $User = User::find($id);
        $User->update($request->all());
        return $User;
    }


}