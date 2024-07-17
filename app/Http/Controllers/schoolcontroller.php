<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Representative;

class SchoolController extends Controller
{
    // Display a list of schools
    public function index()
    {
        $title = 'Schools';
        $activePage = 'schools';
        $schools = School::with('representatives')->get();
        return view('pages.schools', compact('title', 'schools', 'activePage'));
    }

    // Show the form for creating a new school
    public function create()
    {
        $activePage = 'create';
        return view('schools.create', ['title' => 'Add School', 'activePage' => $activePage]);
    }

    // Store newly created school in the database
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'representatives.*.representative_name' => 'required|string|max:255',
            'representatives.*.representative_email' => 'required|string|email|max:255',
        ]);

        // Create school
        $school = School::create([
            'name' => $validatedData['name'],
            'district' => $validatedData['district'],
        ]);

        // Create representatives for the school
        foreach ($validatedData['representatives'] as $repData) {
            $school->representatives()->create([
                'representative_name' => $repData['representative_name'],
                'representative_email' => $repData['representative_email'],
                'school_id' => $school->id,
            ]);
        }

        return redirect()->route('schools.index')->with('success', 'School and representatives added successfully.');
    }

    // Display a specific school
    public function show($id)
    {
        $activePage = 'schools';
        $school = School::with('representatives')->findOrFail($id);
        return view('schools.show', ['title' => 'View School', 'school' => $school, 'activePage' => $activePage]);
    }

    // Show form for editing a specific school
    public function edit($id)
    {
        $activePage = 'schools';
        $title = 'Edit School';
        $school = School::with('representatives')->findOrFail($id);
        return view('schools.edit', compact('title', 'school', 'activePage'));
    }

    // Update specified school in the database
    public function update(Request $request, $id)
    {
        $school = School::findOrFail($id);

        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'representatives.*.representative_name' => 'sometimes|required|string|max:255',
            'representatives.*.representative_email' => 'sometimes|required|string|email|max:255',
        ]);

        // Update school
        $school->update([
            'name' => $validatedData['name'],
            'district' => $validatedData['district'],
        ]);

        // Update representatives for the school
        if (isset($validatedData['representatives'])) {
            foreach ($validatedData['representatives'] as $repData) {
                $representative = $school->representatives()->where('representative_email', $repData['representative_email'])->first();
                if ($representative) {
                    $representative->update([
                        'representative_name' => $repData['representative_name'],
                        'representative_email' => $repData['representative_email'],
                    ]);
                } else {
                    $school->representatives()->create([
                        'representative_name' => $repData['representative_name'],
                        'representative_email' => $repData['representative_email'],
                        'school_id' => $school->id,
                    ]);
                }
            }
        }

        return redirect()->route('schools.index')->with('success', 'School updated successfully.');
    }

    // Remove a specific school from the storage
    public function destroy($id)
    {
        $school = School::findOrFail($id);
        $school->delete();
        return redirect()->route('schools.index')->with('success', 'School deleted successfully.');
    }
   //defines relationship btn reps and the schools
    public function representatives()
    {
        return $this->hasMany(Representative::class);
    }
}
