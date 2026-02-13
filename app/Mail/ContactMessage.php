<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $subjectText;
    public $messageText;

    public function __construct($name, $email, $subjectText, $messageText)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subjectText = $subjectText;
        $this->messageText = $messageText;
    }

    public function build()
    {
        return $this->subject('Nouveau message : ' . $this->subjectText)
                    ->replyTo($this->email)
                    ->view('emails.contact-message');
    }
}
