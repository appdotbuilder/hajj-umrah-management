<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ThemeController extends Controller
{
    /**
     * Update the user's theme preference.
     */
    public function update(Request $request)
    {
        $request->validate([
            'theme' => ['required', Rule::in(['purple', 'green', 'blue'])],
        ]);

        $request->user()->update([
            'theme' => $request->theme,
        ]);

        return back()->with('success', 'Theme updated successfully.');
    }
}