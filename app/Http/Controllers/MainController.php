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
            'bc_img' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'resume' => 'nullable|mimes:pdf',
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
    public function update(Request $request, Main $main)
{
    $validated = $request->validate([
        'title' => 'required|string',
        'sub_title' => 'required|string',
        'bc_img' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'resume' => 'nullable|mimes:pdf',
    ]);

    $main->title = $request->title;
    $main->sub_title = $request->sub_title;

    // BC Image আপডেট
    if ($request->hasFile('bc_img')) {
        if ($main->bc_img && file_exists(public_path($main->bc_img))) {
            unlink(public_path($main->bc_img)); // পুরনো ছবি মুছে দাও
        }
        $img_file = $request->file('bc_img');
        $img_name = 'bc_img_' . time() . '.' . $img_file->getClientOriginalExtension();
        $img_file->move(public_path('img'), $img_name); 
        $main->bc_img = 'img/' . $img_name;
    }

    // Resume PDF আপডেট
    if ($request->hasFile('resume')) {
        if ($main->resume && file_exists(public_path($main->resume))) {
            unlink(public_path($main->resume)); // পুরনো PDF মুছে দাও
        }
        $pdf_file = $request->file('resume');
        $pdf_name = 'resume_' . time() . '.' . $pdf_file->getClientOriginalExtension();
        $pdf_file->move(public_path('pdf'), $pdf_name); 
        $main->resume = 'pdf/' . $pdf_name;
    }

    $main->save();

    return redirect()->route('admin.main');
}

    /**
     * Remove the specified resource from storage.
     */

}
