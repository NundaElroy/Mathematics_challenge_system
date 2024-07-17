<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Question;
use App\Models\Challenge;



class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

}
