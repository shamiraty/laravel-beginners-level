<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    //return index
    public function index()
    {
        $regions = Region::all();
        return view('regions.index', compact('regions'));
    }

    //insert return page
    public function create()
    {
        return view('regions.create');
    }

    //insert operation
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:regions|max:255',
        ]);

        Region::create($request->all());
        return redirect()->route('regions.index')->with('success', 'Region created successfully.');
    }
//update return page
    public function edit(Region $region)
    {
        return view('regions.edit', compact('region'));
    }
//update operation
    public function update(Request $request, Region $region)
    {
        $request->validate([
            'name' => 'required|unique:regions,name,' . $region->id . '|max:255',
        ]);

        $region->update($request->all());
        return redirect()->route('regions.index')->with('success', 'Region updated successfully.');
    }
//delete operation
    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('regions.index')->with('success', 'Region deleted successfully.');
    }
}
