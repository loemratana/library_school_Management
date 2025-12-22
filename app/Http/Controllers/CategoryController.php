<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('Admin.category', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:50',
            'description' => 'required',
        ]);

        Category::insert([
            'name' => $request->name,
            'description' => $request->description,
            'created_at' => now(),
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' => 'required|max:50|unique:categories,name,' . $id,
            'description' => 'required',
        ]);

        Category::findOrFail($id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
