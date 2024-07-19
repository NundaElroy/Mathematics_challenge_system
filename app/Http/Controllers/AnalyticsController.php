<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\School;
use App\Models\Participant;
use App\Models\Challenge;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function showAnalytics()
    {
        // Example analytics data
        $mostCorrectlyAnsweredQuestions = Question::withCount('correctAnswers')->orderBy('correct_answers_count', 'desc')->take(10)->get();
        $schoolRankings = School::with('participants')->get()->sortByDesc(function ($school) {
            return $school->participants->avg('score');
        });
        
        $performanceOverYears = DB::table('participants')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('avg(score) as average_score'))
            ->groupBy('year')
            ->get();
        
        $bestPerformingSchools = School::with('participants')->get()->sortByDesc(function ($school) {
            return $school->participants->avg('score');
        })->take(10);

        $worstPerformingSchools = School::with('participants')->get()->sortBy(function ($school) {
            return $school->participants->avg('score');
        })->take(10);

        $incompleteChallenges = Participant::whereHas('challenges', function ($query) {
            $query->where('status', '!=', 'completed');
        })->get();

        // Pass data to the view
        return view('analytics', compact('mostCorrectlyAnsweredQuestions', 'schoolRankings', 'performanceOverYears', 'bestPerformingSchools', 'worstPerformingSchools', 'incompleteChallenges'));
    }
}

