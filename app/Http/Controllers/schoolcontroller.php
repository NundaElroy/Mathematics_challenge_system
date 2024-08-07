<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    // Display a list of schools
    public function index()
    {
        $title = 'Schools';
        $activePage = 'schools';
        $schools = School::with('representative')->get(); // Use the correct relationship
        return view('pages.schools', compact('title', 'schools', 'activePage'));
    }

    // Show the form for creating a new school
    public function create()
    {
        $title = 'Add School';
        $activePage = 'create';
        return view('schools.create', compact('title', 'activePage'));
    }

    // Store a newly created school in the database
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'registration_no' => 'required|string|unique:schools,registration_no',
            'name' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'representative_name' => 'required|string|max:255',
            'representative_email' => 'required|email|max:255',
        ]);

        // Create and save the new school record
        School::create($request->all());

        // Redirect to the index page with a success message
        return redirect()->route('schools.index')->with('success', 'School added successfully.');
    }

    // Display a specific school
    public function show($registration_no)
    {
        $title = 'View School';
        $activePage = 'schools';
        $school = School::where('registration_no', $registration_no)->firstOrFail(); // Use registration_no to find the school
        return view('schools.show', compact('title', 'school', 'activePage'));
    }

    // Show the form for editing a specific school
    public function edit($registration_no)
    {
        $title = 'Edit School';
        $activePage = 'schools';
        $school = School::where('registration_no', $registration_no)->firstOrFail(); // Use registration_no to find the school
        return view('schools.edit', compact('title', 'school', 'activePage'));
    }

    // Update the specified school in the database
    public function update(Request $request, $registration_no)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'representative_name' => 'required|string|max:255',
            'representative_email' => 'required|email|max:255',
        ]);

        // Find the school by registration_no and update it
        $school = School::where('registration_no', $registration_no)->firstOrFail();
        $school->update($request->all());

        // Redirect to the index page with a success message
        return redirect()->route('schools.index')->with('success', 'School updated successfully.');
    }
}
