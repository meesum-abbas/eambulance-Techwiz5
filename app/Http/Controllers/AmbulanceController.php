<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmbulanceController extends Controller
{
    public function index()
    {
        $ambulances = Ambulance::all();
        return view('AdminPannel.ambulances.index', compact('ambulances'));
    }

    public function create()
    {
        return view('AdminPannel.ambulances.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'equipment' => 'required|string',
            'cost' => 'required|numeric',
            'size' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $imagePath = 'ambulances/' . $imageName;

        if (Ambulance::where('image', $imagePath)->exists()) {
            return redirect()->back()->withErrors(['image' => 'An ambulance with this image already exists.']);
        }

        $request->image->move(public_path('ambulances'), $imageName);

        Ambulance::create([
            'type' => $request->type,
            'equipment' => $request->equipment,
            'cost' => $request->cost,
            'size' => $request->size,
            'image' => $imagePath,
        ]);

        return redirect()->route('createambulance')->with('success', 'Ambulance created successfully.');
    }

    public function edit(Ambulance $ambulance)
    {
        return view('AdminPannel.ambulances.edit', compact('ambulance'));
    }

    public function update(Request $request, Ambulance $ambulance)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'equipment' => 'required|string',
            'cost' => 'required|numeric',
            'size' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $ambulance->update($request->except('image'));

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $imagePath = 'ambulances/' . $imageName;
            $request->image->move(public_path('ambulances'), $imageName);
            $ambulance->update(['image' => $imagePath]);
        }

        return redirect()->route('showambulance')->with('success', 'Ambulance updated successfully.');
    }

    public function destroy(Ambulance $ambulance)
    {
        $ambulance->delete();
        return redirect()->route('showambulance')->with('success', 'Ambulance deleted successfully.');
    }
}
