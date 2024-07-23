<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\ReportMail; 
use Illuminate\Support\Facades\Mail;

class PdfController extends Controller
{
    //use Illuminate\Support\Facades\DB;

    public function fetchData($challengeId, $attemptid)
    {
        $data = DB::table('attempt_details')
            ->join('questions', 'attempt_details.questionid', '=', 'questions.questionid')
            ->join('participants', 'attempt_details.participantid', '=', 'participants.participantid')
            ->where('attempt_details.challengeId', $challengeId)
            ->where('attempt_details.attemptid', $attemptid)
            ->select(
                'attempt_details.*',
                'questions.question_text',
                'questions.marks',
                'participants.username',
                'participants.firstname',
                'participants.lastname',
                'participants.email',
                'participants.DOB',
                'participants.image',
                'participants.school_registration_no'
            )
            ->get();
    
        return $data;
    }
    
    public function sendReports($challengeId, $participantid)
    {
        // Fetch distinct attempt IDs for the participant
        $attempts = DB::table('attempt_details')
            ->where('participantid', $participantid)
            ->where('challengeId', $challengeId)
            ->distinct()
            ->pluck('attemptid');

        // Loop through each attempt and send a PDF report
        foreach ($attempts as $attemptid) {
            $data = $this->fetchData($challengeId, $attemptid);

            if (!$data->isEmpty()) {
                Mail::to($data[0]->email)->send(new ReportMail($data));
                echo 'Report sent for attempt ID: ' . $attemptid . '<br>';
            } else {
                echo 'No data found for attempt ID: ' . $attemptid . '<br>';
            }
        }
    }

}
