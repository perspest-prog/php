<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

use App\Models\Thing;
use App\Models\User;
use App\Models\Place;
use App\Models\Usage;
use App\Mail\ThingsMail;

class UsageController extends Controller
{
    public function create(Request $request)
    {
        $thing = Thing::findOrFail($request->query('thing_id'));

        Gate::authorize('update', $thing);

        $users = User::all();
        $places = Place::all();

        return view("usages.create", compact('thing', 'users', 'places'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'thing_id'  => 'required|exists:things,id',
            'user_id'   => 'required|exists:users,id',
            'place_id'  => 'required|exists:places,id',
            'amount'    => 'required|integer|min:1',
        ]);

    Usage::updateOrInsert(
        ['thing_id' => $validated['thing_id']], 
        [
            'user_id' => $validated['user_id'],
            'place_id' => $validated['place_id'],
            'amount' => $validated['amount']
        ]
    ); 

    $user = User::find($validated['user_id']);
    $thing = Thing::find($validated['thing_id']);

    Mail::to($user ->email)->send(new ThingsMail($thing));

    return redirect()->route('things.index');
    }
}