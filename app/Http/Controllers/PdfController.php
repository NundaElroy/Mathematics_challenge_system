<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\ReportMail; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class PdfController extends Controller
{
    //fetches data for a give challengeid and attemptid;

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
    
    //all attempt details for a given partcipant for achallenge
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
                Log::info('Report sent for attempt ID: ' . $attemptid);;
            } else {
                Log::info('No data found for attempt ID: ' . $attemptid);
            }
        }
    }

}
