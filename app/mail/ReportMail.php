<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $reportData = $this->data;

        $pdf = PDF::loadView('emails.report', ['data' => $reportData]);

        return $this->view('emails.report')
                    ->attachData($pdf->output(), 'report.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
   
}


