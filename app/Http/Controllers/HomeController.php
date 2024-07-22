<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\Challenge;
use App\Models\Question;
use App\Models\School;
use App\Models\Attempt;
use App\Models\Rejected;
use Illuminate\Support\Facades\Log;
use app\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $participantsCount = Participant::count();
        $challengesCount = Challenge::count();
        $questionsCount = Question::count();
        $schoolsCount = School::count();
        $attemptsCount = Attempt::count();
        $rejectedCount = Rejected::count();
        return view('dashboards.dash',compact(
            'participantsCount',
            'challengesCount',
            'questionsCount',
            'schoolsCount',
            'attemptsCount',
            'rejectedCount'
        ));
    }
    public function isAdmin()
{
    return $this->is_admin;
    $user = App\Models\User::find(1);
    $user->is_admin = true;
    $user->save();
}
}
