<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController
{
    public function list(Request $request)
    {
        $search = $request->input('search');
        $teams =  Team::where('title', 'like', '%' . $search . '%')
            ->orWhere('sub_title', 'like', '%' . $search . '%')
            ->get();
        return view('backend.components.teams_list', compact('teams', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.components.teams_create');
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
            'twitter' => 'required|url|max:255',
            'facebook' => 'required|url|max:255',
            'linkedin' => 'required|url|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create new Team
        $team = new Team;
        $team->title = $request->title;
        $team->sub_title = $request->sub_title;
        $team->twitter = $request->twitter;
        $team->facebook = $request->facebook;
        $team->linkedin = $request->linkedin;

        // Image upload
         if ($request->hasFile('image')) {
            $img_file = $request->file('image');
            $img_name = 'image.' . $img_file->getClientOriginalExtension();
            $img_file->move(public_path('img'), $img_name); // move to public/img
            $team->image = 'img/' . $img_name;
        }

        // Save
        $team->save();

        // Redirect with success message
        return redirect()->route('admin.teams.create')
            ->with('success', 'Team member created successfully.');
    }


    public function edit($id)
    {
        $teams = Team::find($id);
        return view('backend.components.teams_edit', compact('teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $teams =  Team::find($id);
        $teams->title = $request->title;
        $teams->sub_title = $request->sub_title;
        $teams->twitter = $request->twitter;
        $teams->facebook = $request->facebook;
        $teams->linkedin = $request->linkedin;

        if ($request->hasFile('image')) {
            $big_file = $request->file('image');
            $path = $big_file->store('img', 'public');
            $teams->image = 'storage/' . $path;
        }

        $teams->save();
        return redirect()->route('admin.teams.list')->with('success', 'Team member updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $teams = Team::find($id);
        @unlink(public_path($teams->image));
        $teams->delete();
        return redirect()->route('admin.teams.list')->with('success', 'Team deleted!');
    }
}
