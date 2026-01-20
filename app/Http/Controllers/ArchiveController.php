<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Thing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchiveController extends Controller
{
    public function index() {
        $archiveThings = Archive::all();

        return view('archive.index', compact('archiveThings'));
    }

    public function update(Request $request, Archive $archive) {
        // PUT /archive/1
        
        Thing::create([
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

        return redirect() -> route('things.index');
    }
}
