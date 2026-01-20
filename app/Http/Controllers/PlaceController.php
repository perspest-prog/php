<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Place;

use Illuminate\Support\Facades\Cache;

class PlaceController extends Controller
{   
  public function index() 
  {
    Gate::authorize('viewAny', Place::class);

    $places = Cache::remember('places_all', 3600, function() {
        return Place::all();
    });
    
    return view("places.index", compact('places'));
  }

  public function create()
  {
    Gate::authorize('create', Place::class);

      return view('places.create');
  }

  public function store(Request $request)
  {
    Gate::authorize('create', Place::class);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'repair' => 'required|boolean',
        'work' => 'required|boolean',
    ]);

    Place::create($validated);

    return redirect()->route('places.index');
  }

  public function show(Place $place)
    {
        Gate::authorize('view', $place);

        return view('places.show', compact('place'));
    }

    public function edit(Place $place)
    {
        Gate::authorize('update', $place);

        return view('places.edit', compact('place'));
    }

  public function update(Request $request, Place $place)
    {
        Gate::authorize('update', $place);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'repair' => 'required|boolean',
            'work' => 'required|boolean',
        ]);

        $place->update($validated);

        Cache::forget('places_all');
        Cache::forget("place_{$place->id}");

        return redirect()->route('places.index');
    }

    public function destroy(Place $place)
    {
        Gate::authorize('update', $place);

        $id = $place->id;
        $place->delete();

        Cache::forget('places_all');
        Cache::forget("place_{$id}");
        
        return redirect()->route('places.index');
    }
}
