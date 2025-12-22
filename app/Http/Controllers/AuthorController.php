<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::latest()->get();
        return view('Admin.author', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'FirstName' => 'required|max:50',
            'LastName' => 'required|max:50',
        ]);

        Author::create([
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
        ]);

        $notification = array(
            'message' => 'Author Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function update(Request $request)
    {
        $author_id = $request->id;

        $request->validate([
            'FirstName' => 'required|max:50',
            'LastName' => 'required|max:50',
        ]);

        Author::findOrFail($author_id)->update([
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
        ]);

        $notification = array(
            'message' => 'Author Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        Author::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Author Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
