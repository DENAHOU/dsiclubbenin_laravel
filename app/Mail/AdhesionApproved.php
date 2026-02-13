<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdhesionApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $item;
    public $memberType;
    public $loginUrl;

    public function __construct($item)
    {
        $this->item = $item;
        $this->memberType = $item->type_members ?? 'user';
        $this->loginUrl = url('/login');
    }

public function build()
{
    return $this->subject('Demande d’adhésion reçue 🎉 — Club DSI Bénin')
        ->view('emails.adhesion-approved')
        ->with([
            'name' => $this->item->name ?? $this->item->firstname ?? 'Cher membre',
            'type' => $this->memberType
        ]);
}

}
