<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    public function viewLetter()
    {
        return view('letters.create-letters');
    }

    public function createLetter(Request $request)
    {
        $validated = $request->validate([
            'letter_title' => 'required',
            'letter_content' => 'nullable',
            'letter_status' => 'required',
            'finalized_at' => 'nullable'
        ]);

        Letter::create([
            'letter_title' => $validated['letter_title'],
            'letter_content' => $validated['letter_content'],
            'letter_status' => $validated['letter_status'],
            'finalized_at' => $validated['finalized_at'],
        ]);

        return redirect()->route('view.letter');
    }
}
