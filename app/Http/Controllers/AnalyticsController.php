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

   
   public function showAnalytics()
   {
       // Fetch the most correctly answered questions
       $mostCorrectlyAnsweredQuestions = $this->mostCorrectlyAnsweredQuestions();
       
       // Fetch the school rankings
       $schoolRankings = $this->getSchoolRankings();
       
       // Fetch the worst performing schools per challenge
       $worstPerformingSchools = $this->getWorstPerformingSchools();
      
       //best per challenge
       $bestPerformingSchools = $this->getBestPerformingSchools();

      
       // Pass the data to the view
       return view('analytics.analytics', [
           'groupedByChallenge' => $mostCorrectlyAnsweredQuestions,
           'schoolRankings' => $schoolRankings,
           'worstPerformingSchools' => $worstPerformingSchools,
           'bestPerformingSchools' => $worstPerformingSchools
       ]);
   }
   
private function mostCorrectlyAnsweredQuestions()
{
    // Fetch the correctly answered questions grouped by challenge_id and questionid
    $mostCorrectlyAnsweredQuestions = DB::table('attempt_details')
        ->select('attempt_details.challengeId', 'attempt_details.questionid', DB::raw('count(*) as total_correct'), 'questions.question_text')
        ->join('questions', 'attempt_details.questionid', '=', 'questions.questionid')
        ->where('attempt_details.is_correct', true)
        ->groupBy('attempt_details.challengeId', 'attempt_details.questionid', 'questions.question_text')
        ->orderBy('total_correct', 'desc')
        ->limit(5)
        ->get()
        ->toArray(); // Convert collection to array

    return $mostCorrectlyAnsweredQuestions;
}


   private function getSchoolRankings()
   {
       // Fetch the average score for each school, joined with the schools table
       $schoolRankings = DB::table('attempts')
           ->join('schools', 'attempts.school_registration_no', '=', 'schools.registration_no')
           ->select(
               'schools.registration_no',
               'schools.name',
               'schools.district',
               DB::raw('AVG(attempts.score) as average_score')
           )
           ->groupBy(
               'schools.registration_no',
               'schools.name',
               'schools.district'
           )
           ->orderBy('average_score', 'desc')
           ->get()
           ->toArray(); // Convert collection to array
   
       return $schoolRankings;
   }
   
   //worst performing per challenge
   private function getWorstPerformingSchools()
{
    return DB::table('attempts as a')
        ->join('schools as s', 'a.school_registration_no', '=', 's.registration_no')
        ->select('a.challengeId', 's.registration_no', 's.name', 's.district', DB::raw('AVG(a.score) as average_score'))
        ->groupBy('a.challengeId', 's.registration_no', 's.name', 's.district')
        ->orderBy('average_score', 'asc')
        ->get()
        ->map(function ($item) {
            return (object) [
                'challengeId' => $item->challengeId,
                'registration_no' => $item->registration_no,
                'name' => $item->name,
                'district' => $item->district,
                'average_score' => $item->average_score,
            ];
        });
}

//best performing per challenge

private function getBestPerformingSchools()
{
    return DB::table('attempts as a')
        ->join('schools as s', 'a.school_registration_no', '=', 's.registration_no')
        ->select('a.challengeId', 's.registration_no', 's.name', 's.district', DB::raw('AVG(a.score) as average_score'))
        ->groupBy('a.challengeId', 's.registration_no', 's.name', 's.district')
        ->orderBy('average_score', 'desc')
        ->get()
        ->map(function ($item) {
            return (object) [
                'challengeId' => $item->challengeId,
                'registration_no' => $item->registration_no,
                'name' => $item->name,
                'district' => $item->district,
                'average_score' => $item->average_score,
            ];
        });
}





}

