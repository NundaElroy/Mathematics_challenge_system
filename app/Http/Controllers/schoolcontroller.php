<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\SchoolsImport;
use Illuminate\Http\Request;


class SchoolController extends Controller
{
    public function showUploadForm()
    {
        return view('admin.upload-schools');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'schools_file' => 'required|file|mimes:xlsx',
        ]);

        Excel::import(new SchoolsImport, $request->file('schools_file'));

        return redirect()->back()->with('success', 'Schools uploaded successfully.');
    }
}