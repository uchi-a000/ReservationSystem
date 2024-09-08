<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\UserNotification;
use App\Http\Requests\AdminNotifyRequest;

class AdminNotificationController extends Controller
{
    public function showNotificationForm()
    {
        return view('admin.notify');
    }

    public function confirmNotification(AdminNotifyRequest $request)
    {
        $notify = $request->all();

        return view('admin.confirm', compact('notify'));
    }

    public function sendNotification(Request $request)
    {
        if ($request->has('back')) {
            return redirect('/admin/notify')->withInput();
        }

        $users = User::all();

        foreach($users as $user) {
            $user ->notify(new UserNotification($request->subject, $request->message));
        }

        return redirect()->route('admin.notify')->with('message', 'お知らせメールが送信されました');
    }
}
