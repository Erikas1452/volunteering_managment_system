<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageFromOrganization extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($organizationName, $organizationEmail, $message, $activityName)
    {
        $this->organization = $organizationName;
        $this->email = $organizationEmail;
        $this->message = $message;
        $this->activity = $activityName;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.message-from-organization')->subject("Gavote žinutę iš svanorystės: ".$this->activity)->with([
            'activity' => $this->activity,
            'organization' => $this->organization,
            'message' => $this->message,
            'email' => $this->email,
        ]);;
    }
}
