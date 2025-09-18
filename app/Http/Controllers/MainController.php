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
        ]);
        $main = Main::first();
        $main->title = $request->title;
        $main->sub_title = $request->sub_title;

        if ($request->file('bc_img')) {
            $img_file = $request->file('bc_img');
            $img_file->storeAs('public/img/', 'bc_img.' . $img_file->getClientOriginalExtension());
            $main->bc_img = 'storage/img/bc_img.' . $img_file->getClientOriginalExtension();
        }

        if ($request->file('resume')) {
            $pdf_file = $request->file('resume');
            $pdf_file->storeAs('public/pdf/', 'resume.' . $pdf_file->getClientOriginalExtension());
            $main->resume = 'storage/pdf/resume.' . $pdf_file->getClientOriginalExtension();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Main $main)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Main $main)
    {
        //
    }
}
