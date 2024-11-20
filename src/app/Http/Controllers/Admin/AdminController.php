<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Review;
use App\Models\User;
use App\Imports\ShopsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function adminIndex()
    {
        $representatives = User::role('shop_representative')->get();

        return view('admin.admin_index', compact('representatives'));
    }

    public function store(AdminRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole('shop_representative');
        $user->markEmailAsVerified();

        return redirect()->route('admin.admin_index')->with('message', '店舗代表者が作成されました');
    }

    public function destroy($id)
    {
        $review = Review::find($id);
        $review->delete();

        return redirect()->back()->with('success', '口コミを削除しました。');
    }

    public function showImport()
    {
        return view('admin.shops_import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        try {
            Excel::import(new ShopsImport, $request->file('csv_file'));
            return back()->with('success', 'CSVファイルをインポートしました');
        } catch (\Exception $e) {
            return back()->with('error', 'インポートに失敗しました：' . $e->getMessage());
        }
    }
}
