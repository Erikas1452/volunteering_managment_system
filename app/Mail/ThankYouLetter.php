<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThankYouLetter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($organizationName, $organizationEmail, $message, $activityName, $hours)
    {
        $this->organization = $organizationName;
        $this->email = $organizationEmail;
        $this->message = $message;
        $this->activity = $activityName;
        $this->hours = $hours;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.thank-you-letter')->subject("Padėka už dalyvavimą ".$this->activity. " savanorystėje")->with([
            'activity' => $this->activity,
            'organization' => $this->organization,
            'message' => $this->message,
            'email' => $this->email,
            'hours' => $this->hours,
        ]);;
    }
}
