<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;
use App\Models\User;



class AdminController extends Controller
{
    public function adminIndex()
    {
        $representatives = User::role('shop_representative')->get();

        return view('admin.admin_index', compact('representatives'));
    }

    public function store(AdminRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole('shop_representative');

        return redirect()->route('admin.admin_index')->with('message', '店舗代表者が作成されました');
    }
}
