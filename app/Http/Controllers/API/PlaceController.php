<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;

class PlaceController extends Controller
{
    # GET /api/places
    public function index()
    {
        Gate::authorize('viewAny', Place::class);

        $places = Cache::remember('places_all', 3600, function() {
            return Place::all();
        });
        
        return response()->json($places);
    }

    # POST /api/places
    public function store(Request $request)
    {
        Gate::authorize('create', Place::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'repair' => 'required|boolean',
            'work' => 'required|boolean',
        ]);

        $place = Place::create($validated);
        
        Cache::forget('places_all');

        return response()->json($place, 201);
    }

    # GET /api/places/{place}
    public function show(Place $place)
    {
        Gate::authorize('view', $place);

        return response()->json($place);
    }

    # PUT/PATCH /api/places/{place}
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

        return response()->json($place);
    }

    # DELETE /api/places/{place}
    public function destroy(Place $place)
    {
        Gate::authorize('update', $place);

        $id = $place->id;
        $place->delete();

        Cache::forget('places_all');
        Cache::forget("place_{$id}");
        
        return response()->json(null, 204);
    }
}