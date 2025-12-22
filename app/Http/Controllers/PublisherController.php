<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::latest()->get();
        return view('Admin.publisher', compact('publishers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:150',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|max:20',
            'address' => 'nullable|max:255',
        ]);

        Publisher::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $notification = array(
            'message' => 'Publisher Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function update(Request $request)
    {
        $publisher_id = $request->id;

        $request->validate([
            'name' => 'required|max:150',
            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|max:20',
            'address' => 'nullable|max:255',
        ]);

        Publisher::findOrFail($publisher_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $notification = array(
            'message' => 'Publisher Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        Publisher::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Publisher Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
