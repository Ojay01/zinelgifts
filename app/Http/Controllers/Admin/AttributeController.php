<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Quality;
use App\Models\Type;
use App\Models\Size;
class AttributeController 
{
    
    public function indexType()
    {
        $types = Type::paginate(10);
        return view('admin.attributes.types', compact('types'));
    }

    public function storeType(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Type::create($validated);

        return redirect()->back()
            ->with('success', 'Type created successfully.');
    }

    public function updateType(Request $request, Type $type)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $type->update($validated);

        return redirect()->back()
            ->with('success', 'Type updated successfully.');
    }

    public function destroyType(Type $type)
    {
        $type->delete();

        return redirect()->back()
            ->with('success', 'Type deleted successfully.');
    }


    public function indexQuality()
    {
        $qualities = Quality::paginate(10);
        return view('admin.attributes.qualities', compact('qualities'));
    }

    public function storeQuality(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Quality::create($validated);

        return redirect()->back()
            ->with('success', 'Quality created successfully.');
    }

    public function updateQuality(Request $request, Quality $quality)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $quality->update($validated);

        return redirect()->back()
            ->with('success', 'Quality updated successfully.');
    }

    public function destroyQuality(Quality $quality)
    {
        $quality->delete();

        return redirect()->back()
            ->with('success', 'Quality deleted successfully.');
    }


    public function sizesIndex()
    {
        $sizes = Size::paginate(10);
        return view('admin.attributes.sizes', compact('sizes'));
    }

    public function storeSize(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Size::create($validated);

        return redirect()->back()
            ->with('success', 'Size created successfully.');
    }

    public function updateSize(Request $request, Size $size)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $size->update($validated);

        return redirect()->back()
            ->with('success', 'Size updated successfully.');
    }

    public function destroySize(Size $size)
    {
        $size->delete();

        return redirect()->back()
            ->with('success', 'Size deleted successfully.');
    }

}
