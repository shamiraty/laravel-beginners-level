<?php


namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // Show all departments
    public function index()
    {
        $departments = Department::all(); // Fetch all departments
        return view('departments.index', compact('departments'));
    }

    // Show form for creating a new department
    public function create()
    {
        return view('departments.create');
    }

    // Store a newly created department
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Department::create($validated);

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    // Show the form for editing the specified department
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    // Update the specified department
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $department->update($validated);

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    // Remove the specified department
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
