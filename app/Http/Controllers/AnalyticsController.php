<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

use App\Models\Participant;
use App\Models\AttemptDetail;

use Illuminate\Support\Facades\DB;
//use App\Models\Challenge;
class AnalyticsController extends Controller
{
    /*public function showAnalytics()
    {  */
        // Example analytics data
       /* $mostCorrectlyAnsweredQuestions = Question::withCount('correctAnswers')->orderBy('correct_answers_count', 'desc')->take(10)->get();
        $schoolRankings = School::with('participants')->get()->sortByDesc(function ($school) {
            return $school->participants->avg('score');
        });*/
        
        /* $performanceOverYears = DB::table('participants')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('avg(score) as average_score'))
            ->groupBy('year')
            ->get(); */
        
        /*$bestPerformingSchools = School::with('participants')->get()->sortByDesc(function ($school) {
            return $school->participants->avg('score');
        })->take(10);*/

        /*$worstPerformingSchools = School::with('participants')->get()->sortBy(function ($school) {
            return $school->participants->avg('score');
        })->take(10);*/

       /* $incompleteChallenges = Participant::whereHas('challenges', function ($query) {
            $query->where('status', '!=', 'completed');
        })->get();*/

       
   // }
   public function store(Request $request) {
    $data= $request->all();
    $data['is_correct']=$data['store']==10;
    AttemptDetail::create($data);
    return
    response()->json(['success'=>true]);
   }
   public function mostCorrectlyAnsweredQuestions()
   {
    $mostCorrectlyAnsweredQuestions=DB::table('attempt_details')->select('questionid',DB::raw('count(*) as total_correct'))
    ->where('is_correct', true)
    ->groupBy('questionid')
    ->orderBy('total_correct','desc')
    ->get();
       /*$questions = Question::withCount(['attemptDetails as correct_answers' => function ($query) {
           $query->where('is_correct', true);
       }])->orderBy('correct_answers', 'desc')->get();*/

       return view('pages.analytics',['questions'=>$mostCorrectlyAnsweredQuestions]);
   }





}

