<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController
{
    /**
     * Display a listing of the resource.
     */
     public function list(Request $request)
    {
        $search = $request->input('search');   
        $abouts = About::where('title', 'like', '%' . $search . '%')
            ->orWhere('sub_title', 'like', '%' . $search . '%')
                         ->orWhere('description', 'like', '%' . $search . '%') ->get();
        return view('backend.components.abouts_list', compact('abouts', 'search'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.components.abouts_create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create new About
        $about = new About;
        $about->title = $request->title;
        $about->sub_title = $request->sub_title;
        $about->description = $request->description;

        // Image upload
        if ($request->hasFile('image')) {
            $img_file = $request->file('image');
            $img_name = 'image.' . $img_file->getClientOriginalExtension();
            $img_file->move(public_path('img'), $img_name); // move to public/img
            $about->image = 'img/' . $img_name;
        }

        // Save to database
        $about->save();

        // Redirect with success message
        return redirect()->route('admin.abouts.create')
            ->with('success', 'About created successfully.');
    }

    public function edit($id)
    {
        $abouts = About::find($id);
        return view('backend.components.abouts_edit', compact('abouts'));
    }
    public function update(Request $request, $id)
    {

        $abouts = About::find($id);
        $abouts->title = $request->title;
        $abouts->sub_title = $request->sub_title;
        $abouts->description = $request->description;

        if ($request->file('image')) {
            $image_file = $request->file('image');
            Storage::putFile('public/img/', $image_file);
            $abouts->image = "storage/img/" . $image_file->hashName();
        }

        $abouts->save();

        return redirect()->route('admin.abouts.list')->with('success', 'About Updated Successfully');
    }
    public function destroy($id)
    {
        $abouts = About::find($id);
        @unlink(public_path($abouts->image));
        @unlink(public_path($abouts->image));
        $abouts->delete();

        return redirect()->route('admin.abouts.list')->with('success', 'Abouts deleted!');
    }
}
