<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($activity,$volunteer,$email,$message)
    {
        $this->activity = $activity;
        $this->volunteer = $volunteer;
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.message-mail')->subject("Gavote žinutę iš Savanorio: ".$this->volunteer)->with([
            'activity' => $this->activity,
            'volunteer' => $this->volunteer,
            'message' => $this->message,
            'email' => $this->email,
        ]);
    }
}
