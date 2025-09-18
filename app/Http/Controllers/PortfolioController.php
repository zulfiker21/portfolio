<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $portfolios = Portfolio::all();
        return view('backend.components.portfolios_list', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.components.portfolios_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'description' => 'required|string',
            'client' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'big_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'small_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:1024',
        ]);

        // Create new Portfolio
        $portfolio = new Portfolio;
        $portfolio->title = $request->title;
        $portfolio->sub_title = $request->sub_title;
        $portfolio->description = $request->description;
        $portfolio->client = $request->client;
        $portfolio->category = $request->category;

        // Big Image Upload
        if ($request->hasFile('big_image')) {
            $big_file = $request->file('big_image');
            $big_path = $big_file->store('img', 'public');
            $portfolio->big_image = 'storage/' . $big_path;
        }

        // Small Image Upload
        if ($request->hasFile('small_image')) {
            $small_file = $request->file('small_image');
            $small_path = $small_file->store('img', 'public');
            $portfolio->small_image = 'storage/' . $small_path;
        }

        // Save to database
        $portfolio->save();

        // Redirect with success message
        return redirect()->route('admin.portfolios.create')
            ->with('success', 'Portfolio created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $portfolios = Portfolio::find($id);
        return view('backend.components.portfolios_edit', compact('portfolios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {


        $portfolios = Portfolio::find($id);
        $portfolios->title = $request->title;
        $portfolios->sub_title = $request->sub_title;
        $portfolios->description = $request->description;
        $portfolios->client = $request->client;
        $portfolios->category = $request->category;

        if ($request->file('big_image')) {
            $big_file = $request->file('big_image');
            Storage::putFile('public/img/', $big_file);
            $portfolios->big_image = "storage/img/" . $big_file->hashName();
        }

        if ($request->file('small_image')) {
            $small_file = $request->file('small_image');
            Storage::putFile('public/img/', $small_file);
            $portfolios->small_image = "storage/img/" . $small_file->hashName();
        }

        $portfolios->save();

        return redirect()->route('admin.portfolios.list')->with('success', 'Portfolio updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $portfolios = Portfolio::find($id);
        @unlink(public_path($portfolios->big_image));
        @unlink(public_path($portfolios->small_image));
        $portfolios->delete();

        return redirect()->route('admin.portfolios.list')->with('success', 'Portfolio deleted!');
    }
}
