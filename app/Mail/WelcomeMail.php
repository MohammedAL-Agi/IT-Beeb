<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData;
    /**
     * Create a new message instance.
     *
     * @param $emailData
     */
    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    /**
     * Build the message.
     *
     * @return SendMail
     */
    public function build()
    {
        return $this->from('mohammedalaggi@gmail.com', 'Alagi.org')->subject('No-reply')->view('welcome')
            ->with([
                'name'     => $this->emailData['name'],
                'mobile'   => $this->emailData['mobile'],
                'feeling'  => $this->emailData['feeling'],
                'services' => $this->emailData['services']
            ]);
    }
}
