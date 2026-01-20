<?php

namespace App\Http\Controllers\API;

use App\Models\Archive;
use App\Models\Thing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchiveController extends Controller
{
    # GET /api/archive
    public function index()
    {
        $archiveThings = Archive::all();

        return response()->json($archiveThings);
    }
    # update -> restore
    # PATCH /api/archive/{archive}/restore
    public function restore(Archive $archive)
    {
        $thing = Thing::create([
            'name' => $archive->name,
            'description' => [
                'variants' => [$archive->description],
                'current' => $archive->description
            ],
            'wrnt' => $archive->wrnt,
            'amount' => $archive->amount,
            'master_id' => Auth::id()
        ]);

        $archive->update(['is_restored' => true]);

        return response()->json([
            'message' => 'Предмет успешно восстановлен',
            'thing' => $thing
        ], 201);
    }
}