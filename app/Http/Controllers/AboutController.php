<?php

namespace App\Http\Controllers;

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
            ->orWhere('description', 'like', '%' . $search . '%')
            ->get();

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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        $about = new About;
        $about->title = $request->title;
        $about->sub_title = $request->sub_title;
        $about->description = $request->description;

        // Image Upload
        if ($request->hasFile('image')) {
            $img_file = $request->file('image');
            $img_name = uniqid() . '.' . $img_file->getClientOriginalExtension();
            $img_file->move(public_path('img'), $img_name);
            $about->image = 'img/' . $img_name;
        }

        $about->save();

        return redirect()->route('admin.abouts.list')->with('success', 'About created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $abouts = About::findOrFail($id);
        return view('backend.components.abouts_edit', compact('abouts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $about = About::findOrFail($id);

        $about->title = $request->title;
        $about->sub_title = $request->sub_title;
        $about->description = $request->description;

        // Image Update
        if ($request->hasFile('image')) {
            // পুরানো ইমেজ থাকলে মুছে ফেলবে
            if ($about->image && file_exists(public_path($about->image))) {
                unlink(public_path($about->image));
            }

            $img_file = $request->file('image');
            $img_name = uniqid() . '.' . $img_file->getClientOriginalExtension();
            $img_file->move(public_path('img'), $img_name);
            $about->image = 'img/' . $img_name;
        }

        $about->save();

        return redirect()->route('admin.abouts.list')->with('success', 'About updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $about = About::findOrFail($id);

        if ($about->image && file_exists(public_path($about->image))) {
            unlink(public_path($about->image));
        }

        $about->delete();

        return redirect()->route('admin.abouts.list')->with('success', 'About deleted!');
    }
}
