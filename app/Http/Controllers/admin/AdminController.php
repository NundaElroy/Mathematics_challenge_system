<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Question;
use App\Models\Challenge;
use App\Http\Controllers\Controller;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

}
