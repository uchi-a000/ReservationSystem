<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class CustomRegisteredUserController extends Controller
{
    public function store(RegisterRequest $request) {

        event(new Registered (User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])));

        return view('thanks');
    }
}
