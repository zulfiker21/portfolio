<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Main;
use Illuminate\Http\Request;

class MainController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $main = Main::first();
        return view('backend.components.main', compact('main'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.components.dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'sub_title' => 'required|string',
            'bc_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'resume' => 'nullable|mimes:pdf|max:10000',
        ]);

        $main = Main::first();

        if (!$main) {
            $main = new Main();
        }

        $main->title = $request->title;
        $main->sub_title = $request->sub_title;

        if ($request->hasFile('bc_img')) {
            $img_file = $request->file('bc_img');
            $img_name = 'bc_img.' . $img_file->getClientOriginalExtension();
            $img_file->move(public_path('img'), $img_name); 
            $main->bc_img = 'img/' . $img_name;
        }

        if ($request->hasFile('resume')) {
            $pdf_file = $request->file('resume');
            $pdf_name = 'resume.' . $pdf_file->getClientOriginalExtension();
            $pdf_file->move(public_path('pdf'), $pdf_name); 
            $main->resume = 'pdf/' . $pdf_name;
        }

        $main->save();

        return redirect()->route('admin.main');
    }

    /**
     * Display the specified resource.
     */
    public function show(Main $main)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Main $main)
    {
        return view('backend.components.edit_main', compact('main'));
    }

    /**
     * Update the specified resource in storage.
     */
   

    /**
     * Remove the specified resource from storage.
     */

}
