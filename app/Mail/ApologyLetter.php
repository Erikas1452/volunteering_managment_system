<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApologyLetter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($organizationName, $organizationEmail, $activityName)
    {
        $this->organization = $organizationName;
        $this->email = $organizationEmail;
        $this->activity = $activityName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.apology-letter')->subject("Veikla". $this->activity." į kurią registravotės buvo pašalinta")->with([
            'activity' => $this->activity,
            'organization' => $this->organization,
            'email' => $this->email,
        ]);;
    }
}
