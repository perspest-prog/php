<?php

namespace App\Http\Controllers;

use App\Events\ThingCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Models\Thing;
use App\Mail\ThingsMail;
use App\Mail\ThingUpdatedMail;
use App\Models\Archive;

class ThingController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Thing::class);
        
        $things = Cache::remember('things_all', 3600, function () {
            return Thing::all();
        });

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

        return view('things.index', compact('things'));
    }

    public function create()
    {
        Gate::authorize('create', Thing::class);

        return view('things.create');
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

        Cache::forget('things_all');

        broadcast(new ThingCreated($thing))->toOthers();

        return redirect()->route('things.index');
    }

    public function show(Thing $thing)
    {
        Gate::authorize('view', $thing);
        
        $thing = Cache::remember("thing_{$thing->id}", 3600, function () use ($thing) {
            return $thing;
        });

        return view('things.show', compact('thing'));
    }

    public function edit(Thing $thing)
    {
        Gate::authorize('update', $thing);

        return view('things.edit', compact('thing'));
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
        array_push($variants, $validated['new_description']);
        
        if ($thing->description['current'] != $validated['current_description'] || $validated['new_description'] != '') {
            if ($thing->master) {
                $email = $thing->master->email;
                Mail::to($email)->send(new ThingUpdatedMail($thing));
            }
        }

        $thing->update([
            ...$validated,
            'description' => [
                'variants' => $variants,
                'current' => $validated['current_description']
            ]
        ]);
        
        Cache::forget('things_all');
        Cache::forget("thing_{$thing->id}");

        Mail::to($thing->master->email)->send(new ThingsMail($thing));

        return redirect()->route('things.show', $thing->id);
    }

    public function destroy(Thing $thing)
    {
        Gate::authorize('delete', $thing);
        
        $id = $thing->id;

        Archive::create([
            'name' => $thing->name,
            'description' => $thing->description['current'],
            'master' => $thing->master->name,
            'amount' => $thing->amount,
            'wrnt' => $thing->wrnt
        ]);

        $thing->delete();

        Cache::forget('things_all');
        Cache::forget("thing_{$id}");
        
        return redirect()->route('things.index');
    }
}
