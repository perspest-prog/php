<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Thing;
use App\Models\Archive;

class ThingController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Thing::class);
        
        $things = Thing::all();

        $filter = $request->query('filter');
        
        if ($filter == 'my') {
            $things = $things->filter(function ($thing) {
                return $thing->master_id == Auth::id();
            });
        }
        if ($filter == 'inWork') {
            $things = $things->filter(function ($thing) {
                return $thing->usage->place->work;
            });
        }
        if ($filter == 'inRepair') {
            $things = $things->filter(function ($thing) {
                return $thing->usage->place->repair;
            });
        }
        if ($filter == 'inUsage') {
            $things = $things->filter(function ($thing) {
                return $thing->usage;
            });
        }

        return response()->json($things->values());
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Thing::class);
        
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'wrnt' => 'required|date',
            'amount' => 'required|int|min:1'
        ]);

        $thing = Thing::create([
            ...$validated,
            'description' => [
                'variants' => array_key_exists('description', $validated) ? [$validated['description']] : [],
                'current' => $validated['description'] ?? null
            ],
            'master_id' => Auth::id(), 
        ]);

        return response()->json($thing, 201);
    }

    public function show(Thing $thing)
    {
        Gate::authorize('view', $thing);

        return response()->json($thing);
    }

    public function update(Request $request, Thing $thing)
    {
        Gate::authorize('update', $thing);

        $validated = $request->validate([
            'name' => 'required|string',
            'wrnt' => 'required|date',
            'new_description' => 'nullable|string',
            'current_description' => 'required|string'
        ]);

        $variants = $thing->description['variants'];
        array_push($variants, $validated['current_description']);

        $thing->update([
            ...$validated,
            'description' => [
                'variants' => $variants,
                'current' => $validated['current_description']
            ]
        ]);

        return response()->json($thing);
    }

    public function destroy(Thing $thing)
    {
        Gate::authorize('delete', $thing);

        Archive::create([
            'name' => $thing->name,
            'description' => $thing->description['current'],
            'master' => $thing->master->name,
            'amount' => $thing->amount,
            'wrnt' => $thing->wrnt
        ]);

        $thing->delete();

        return response()->json(null, 204);
    }
}