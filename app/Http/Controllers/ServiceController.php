<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController
{

    public function list(Request $request)
    {
        $search = $request->input('search');
        $services = Service::where('title', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->get();
        return view('backend.components.services_list', compact('services', 'search'));
    }

    public function create()
    {
        return view('backend.components.services_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $services = new Service;
        $services->icon = $request->icon;
        $services->title = $request->title;
        $services->description = $request->description;
        $services->save();

        return redirect()->route('admin.services.create')->with('success', 'Service created successfully.');
    }



    public function edit($id)
    {
        $services = Service::findOrFail($id);
        return view('backend.components.services_edit', compact('services'));
    }

    public function update(Request $request, $id)
    {
        $services = Service::find($id);
        $services->icon = $request->icon;
        $services->title = $request->title;
        $services->description = $request->description;

        $services->save();

        return redirect()->route('admin.services.list')->with('success', 'Service updated successfully.');
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();

        return redirect()->route('admin.services.list')->with('success', 'Service deleted successfully.');
    }
}
