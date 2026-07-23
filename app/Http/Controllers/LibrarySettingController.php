<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibrarySetting;

class LibrarySettingController extends Controller
{
    public function index()
    {
        $settings = LibrarySetting::all()->pluck('value', 'key')->toArray();
        return view('Admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token']);

        foreach ($data as $key => $value) {
            LibrarySetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with([
            'message' => 'Settings updated successfully.',
            'alert-type' => 'success'
        ]);
    }
}
