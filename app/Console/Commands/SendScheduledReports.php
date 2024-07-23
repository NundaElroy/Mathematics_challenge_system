<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SendScheduledReports extends Command
{
    protected $signature = 'reports:send';
    protected $description = 'Send reports based on the scheduled time';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch reports that are scheduled to be sent and haven't been sent yet
        $now = Carbon::now();
        $reports = DB::table('report_schedules')
            ->join('challenge', 'report_schedules.challengeid', '=', 'challenge.challengeid')
            // ->where('report_schedules.timetosend', '<=', $now)//ensure current time is less or = to the current time
            ->where('challenge.closing_date', '<=', $now) // Ensure challenge has ended
            ->where('report_schedules.status', false)
            ->get();

        foreach ($reports as $report) {
            // Fetch all attempts for the given challenge
            $attemptsForGivenChallenge = DB::table('attempts')
                ->where('challengeId', $report->challengeid)
                ->select('challengeId', 'participantid')
                ->distinct()
                ->get();

            foreach ($attemptsForGivenChallenge as $attempt) {
                $controller = new PdfController();
                $controller->sendReports($attempt->challengeId, $attempt->participantid);
            }

            // Optionally, you can remove or mark the report as sent
            DB::table('report_schedules')
            ->where('reportid', $report->reportid)
            ->update(['status' => true]);

            $this->info('Reports sent for challenge ID: ' . $report->challengeid);
        }
    }
}
