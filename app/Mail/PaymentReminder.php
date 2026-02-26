<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $member;

    /**
     * Crée une nouvelle instance du mail
     */
    public function __construct(User $member)
    {
        $this->member = $member;
    }

    /**
     * Construire le message
     */
    public function build()
    {
        return $this->subject('Relance de cotisation Club DSI')
                    ->view('emails.payment_reminder');
    }
}
