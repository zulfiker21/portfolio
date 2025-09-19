<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function list(Request $request)
    {
        $search = $request->input('search');
        $portfolios = Portfolio::where('title', 'like', '%' . $search . '%')
            ->orWhere('sub_title', 'like', '%' . $search . '%')
            ->get();

        return view('backend.components.portfolios_list', compact('portfolios', 'search'));
    }

    public function create()
    {
        return view('backend.components.portfolios_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'description' => 'required|string',
            'client' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'big_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'small_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
        ]);

        $portfolio = new Portfolio();
        $portfolio->title = $request->title;
        $portfolio->sub_title = $request->sub_title;
        $portfolio->description = $request->description;
        $portfolio->client = $request->client;
        $portfolio->category = $request->category;

        // Big Image
        if ($request->hasFile('big_image')) {
            $img_file = $request->file('big_image');
            $path = $img_file->store('img', 'public'); // storage/app/public/img
            $portfolio->big_image = 'storage/' . $path;
        }

        // Small Image
        if ($request->hasFile('small_image')) {
            $img_file = $request->file('small_image');
            $path = $img_file->store('img', 'public');
            $portfolio->small_image = 'storage/' . $path;
        }

        $portfolio->save();

        return redirect()->route('admin.portfolios.create')
            ->with('success', 'Portfolio created successfully.');
    }

    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('backend.components.portfolios_edit', compact('portfolio'));
    }

    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'description' => 'required|string',
            'client' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'big_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'small_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
        ]);

        $portfolio->title = $request->title;
        $portfolio->sub_title = $request->sub_title;
        $portfolio->description = $request->description;
        $portfolio->client = $request->client;
        $portfolio->category = $request->category;

        // Update Big Image
        if ($request->hasFile('big_image')) {
            if ($portfolio->big_image && file_exists(public_path($portfolio->big_image))) {
                unlink(public_path($portfolio->big_image));
            }
            $img_file = $request->file('big_image');
            $path = $img_file->store('img', 'public');
            $portfolio->big_image = 'storage/' . $path;
        }

        // Update Small Image
        if ($request->hasFile('small_image')) {
            if ($portfolio->small_image && file_exists(public_path($portfolio->small_image))) {
                unlink(public_path($portfolio->small_image));
            }
            $img_file = $request->file('small_image');
            $path = $img_file->store('img', 'public');
            $portfolio->small_image = 'storage/' . $path;
        }

        $portfolio->save();

        return redirect()->route('admin.portfolios.list')
            ->with('success', 'Portfolio updated successfully.');
    }

    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        if ($portfolio->big_image && file_exists(public_path($portfolio->big_image))) {
            unlink(public_path($portfolio->big_image));
        }
        if ($portfolio->small_image && file_exists(public_path($portfolio->small_image))) {
            unlink(public_path($portfolio->small_image));
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolios.list')
            ->with('success', 'Portfolio deleted successfully.');
    }
}
