<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

/**
 *
 *  Explanation
 *
 **  Model: The Test model uses name and details fields to allow for flexible testing scenarios.
 **  Controller: The TestController manages CRUD operations on the Test model.
 *
 *  index() fetches all tests and displays them.
 *  store() creates a new test after validating input.
 *  show() displays a single test in detail.
 *  edit() returns test details as JSON for editing in a modal form.
 *  update() updates a test after validating input.
 *  destroy() deletes a test.
 *
 **  Routes
 *  GET /tests - Lists all tests (index)
 *  GET /tests/create - Shows the form to create a new test (create)
 *  POST /tests - Stores a new test (store)
 *  GET /tests/{test} - Shows a specific test (show)
 *  GET /tests/{test}/edit - Shows the form to edit a test (edit)
 *  PUT/PATCH /tests/{test} - Updates a specific test (update)
 *  DELETE /tests/{test} - Deletes a specific test (destroy)
 */


class TestController extends Controller
{
    public function index()
    {
        $tests = Test::all();
        return view('tests.index', compact('tests')); // Assuming you'll create a view at this path
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'nullable|string|max:1000', // Allows for optional details
        ]);
        
        Test::create($validated);

        return redirect()->back();
    }

    public function show(Test $test)
    {
        return view('tests.show', compact('test')); // Detail view for a specific test
    }

    public function edit(Test $test)
    {
        return response()->json($test);
    }

    public function update(Request $request, Test $test)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'nullable|string|max:1000',
        ]);

        $test->update($validated);

        return redirect()->back()->with('success', 'Test updated successfully!');
    }

    public function destroy(Test $test)
    {
        $test->delete();
        return redirect()->back()->with('success', 'Test deleted successfully!');
    }
}
