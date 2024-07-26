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
       // Existing data fetching methods
       $mostCorrectlyAnsweredQuestions = $this->mostCorrectlyAnsweredQuestions();
       $schoolRankings = $this->getSchoolRankings();
       $worstPerformingSchools = $this->getWorstPerformingSchools();
       $bestPerformingSchools = $this->getBestPerformingSchools();
       $schoolPerformance = $this->getSchoolPerformance();
   
       // Fetch top 2 winners per challenge
       $topWinners = $this->getTopWinners();
       $incompleteChallenges =$this->getIncompleteChallenges();
   
       // Pass data to the view
       return view('analytics.analytics', [
           'mostCorrectlyAnsweredQuestions' => $mostCorrectlyAnsweredQuestions,
           'schoolRankings' => $schoolRankings,
           'worstPerformingSchools' => $worstPerformingSchools,
           'bestPerformingSchools' => $bestPerformingSchools,
           'performanceOverYears' => $schoolPerformance,
           'topWinners' => $topWinners,// Pass top winners data
           'incompleteChallenges' => $incompleteChallenges //what is up hereeee
        ]);
   }
   
   
   
   private function mostCorrectlyAnsweredQuestions()
{
    // Get all distinct challenge IDs from attempt_details
    $challengeIds = DB::table('attempt_details')
        ->select('challengeId')
        ->distinct()
        ->get()
        ->pluck('challengeId');

    $results = [];

    // For each challengeId, get the top 5 correctly answered questions
    foreach ($challengeIds as $challengeId) {
        $topQuestions = DB::table('attempt_details')
            ->select('attempt_details.challengeId', 'attempt_details.questionid', 'questions.question_text', DB::raw('count(attempt_details.is_correct) as total_correct'))
            ->join('questions', 'attempt_details.questionid', '=', 'questions.questionid')
            ->where('attempt_details.is_correct', true)
            ->where('attempt_details.challengeId', $challengeId)
            ->groupBy('attempt_details.challengeId', 'attempt_details.questionid', 'questions.question_text')
            ->orderBy('total_correct', 'desc')
            ->limit(5)
            ->get()
            ->toArray();

        $results[$challengeId] = $topQuestions;
    }

    return $results;
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

//school performance over years 
public function getSchoolPerformance()
{
    // Fetch the average scores per school per year. verify this method
    $schoolPerformance = DB::table('attempts as a')
        ->join('schools as s', 'a.school_registration_no', '=', 's.registration_no')
        ->select(
            's.name',
            DB::raw('YEAR(a.attempt_date) as year'),
            DB::raw('AVG(a.score) as average_score')
        )
        ->groupBy('s.name', DB::raw('YEAR(a.attempt_date)'))
        ->orderBy('year', 'asc')
        ->get();

    // Process data to calculate rankings
    $performanceData = [];
    foreach ($schoolPerformance as $performance) {
        $performanceData[$performance->year][$performance->name] = $performance->average_score;
    }

    // Calculate ranks for each school per year
    $ranks = [];
    foreach ($performanceData as $year => $scores) {
        arsort($scores); // Sort scores in descending order
        $rank = 1;
        foreach ($scores as $school => $score) {
            $ranks[$year][$school] = $rank++;
        }
    }

    // Format data for Chart.js
    $formattedData = [];
    foreach ($performanceData as $year => $schools) {
        foreach ($schools as $school => $score) {
            $formattedData[$school][] = [
                'year' => $year,
                'rank' => $ranks[$year][$school] ?? null
            ];
        }
    }

    // Return formatted data
    return $formattedData;
}

//winners per challenge
private function getTopWinners()
{
    // Fetch the top 2 winners per challenge
    return DB::table('attempts as a')
        ->join('participants as p', 'a.participantid', '=', 'p.participantid')
        ->join('schools as s', 'p.school_registration_no', '=', 's.registration_no')
        ->select('a.challengeId', 'p.firstname', 'p.lastname', 'p.image', 's.name as school_name', 'a.score')
        ->whereIn('a.challengeId', function($query) {
            $query->select('challengeid')
                ->from('challenge')
                ->where('closing_date', '<', now());
        })
        ->groupBy('a.challengeId', 'p.participantid', 'p.firstname', 'p.lastname', 'p.image', 's.name', 'a.score')
        ->orderBy('a.challengeId')
        ->orderByDesc('a.score')
        ->get()
        ->mapToGroups(function($item) {
            return [$item->challengeId => (object)[
                'fullname' => $item->firstname . ' ' . $item->lastname,
                'school_name' => $item->school_name,
                'score' => $item->score,
                'image' => $item->image
            ]];
        });
    }
    private function getIncompleteChallenges()
    {
        $incompleteChallenges = Participant::join('attempt_details', 'participants.participantid', '=', 'attempt_details.participantid')
            ->whereNull('attempt_details.timetaken_per_question')
            ->select('participants.*')
            ->distinct()
            ->get();

        return   $incompleteChallenges;
    }






}

