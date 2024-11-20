<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController 
{
    public function index()
    {
        $colors = Color::paginate(10);
        return view('admin.color.index', compact('colors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|string|max:7|regex:/^#[0-9A-F]{6}$/i',
        ]);

        Color::create($validated);

        return redirect()->route('colors.index')
            ->with('success', 'Color created successfully.');
    }

    public function update(Request $request, Color $color)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|string|max:7|regex:/^#[0-9A-F]{6}$/i',
        ]);

        $color->update($validated);

        return redirect()->route('colors.index')
            ->with('success', 'Color updated successfully.');
    }

    public function destroy(Color $color)
    {
        $color->delete();

        return redirect()->route('colors.index')
            ->with('success', 'Color deleted successfully.');
    }
}