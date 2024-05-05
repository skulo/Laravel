<?php


namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    public function index()
    {
        if (!auth()->user()->admin) {
            abort(403, 'Unauthorized');
        }

        $places = Place::all();

        return view('places.index', compact('places'));
    }


    public function edit(Place $place)
    {
        if (!auth()->user()->admin) {
            abort(403, 'Unauthorized');
        }
        return view('places.edit', compact('place'));
    }

    public function update(Request $request, Place $place)
    {

        if (!auth()->user()->admin) {
            abort(403, 'Unauthorized');
        }


        $request->validate([
            'name' => 'required|string|max:200',
            'image' => 'nullable|image|max:5000',
        ]);

        $place->name = $request->name;
        if ($request->hasFile('image')) {

            if (!is_null($place->image)) {
                $oldImagePath = 'public/' . $place->image;
                if (Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }

            $place->image = $request->file('image')->store('places', 'public');
        }
        $place->save();

        return redirect()->route('places.index', $place->id)->with('success');
    }

    public function destroy(Place $place)
    {
        if (!auth()->user()->admin) {
            abort(403, 'Unauthorized');
        }


        if (!is_null($place->image)) {
            $oldImagePath = 'public/' . $place->image;
            if (Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }
        }

        $place->delete();

        return redirect()->back()->with('success');
    }


    public function create()
    {
        if (!auth()->user()->admin) {
            abort(403, 'Unauthorized');
        }

        return view('places.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->admin) {
            abort(403, 'Unauthorized');
        }


        $request->validate([
            'name' => 'required|string|max:200',
            'image' => 'required|image|max:5000',
        ]);

        $place = new Place();
        $place->name = $request->name;

        if ($request->hasFile('image')) {
            $place->image = $request->file('image')->store('places', 'public');
        }

        $place->save();

        return redirect()->route('places.index')->with('success');
    }
}
