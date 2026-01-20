<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Thing;
use App\Models\Usage;

class UsageController extends Controller
{
    # POST /api/usages
    public function store(Request $request)
    {
        $validated = $request->validate([
            'thing_id'  => 'required|exists:things,id',
            'user_id'   => 'required|exists:users,id',
            'place_id'  => 'required|exists:places,id',
            'amount'    => 'required|integer|min:1',
        ]);

        $thing = Thing::findOrFail($validated['thing_id']);

        Gate::authorize('update', $thing);

        Usage::updateOrInsert(
            ['thing_id' => $validated['thing_id']],
            [
                'user_id' => $validated['user_id'],
                'place_id' => $validated['place_id'],
                'amount' => $validated['amount']
            ]
        );

        return response()->json([
            'message' => 'Использование предмета успешно сохранено'
        ], 200);
    }
}