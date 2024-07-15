<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    //dispaly a list of schools
    public function index()
    {
        $title = 'Schools';
        $activePage = 'schools';
        $schools = School::all();
        return view('pages.schools', compact('title', 'schools', 'activePage'));
    }

    //show the form for creating a new school
    public function create()
    {
         $activePage = 'create';
        return view('schools.create' ,  ['title' => 'Add School'], compact('activePage'));
    }

    //store newlyy created school in the database
    public function store(Request $request)
    {
        $school = new School($request->all());
        $school->save();
        return redirect()->route('schools.index');
    }

//display a specific school
    public function show($id)
    {
        $activePage = 'schools';
        $school = School::findOrFail($id);
        return view('schools.show',['title' => 'View School'], compact('school', 'activePage'));
    }

//show form for editing a specific school.
    public function edit($id)
    {
        $activePage = 'schools';
        $title = 'Edit school';
        $school = School::find($id);
        return view('schools.edit', compact('title','school', 'activePage'));
    }

//update specified school in the database
    public function update(Request $request, $id)
    {
        $school = school::findOrFail($id);
        $school->update($request->all());
        return redirect()->route('schools.index')-> with ('success','School updated successfully.');
    }

//Remove a specific school from the storage
    public function destroy($id)
    {
        $school = School::find($id);
        $school->delete();
        return redirect()->route('schools.index')-> with ('success', 'school delleted succefully.');
    }
}
