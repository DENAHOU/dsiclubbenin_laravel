<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdhesionPending extends Mailable
{
    use Queueable, SerializesModels;

    public $item;
    public $memberType;

    public function __construct($item)
    {
        $this->item = $item;
        $this->memberType = $item->type_members ?? 'user';
    }

    public function build()
    {
        return $this->subject('Demande d’adhésion reçue 🎉 — Club DSI Bénin')
            ->view('emails.adhesion-pending')
            ->with([
                'name' => $this->item->name ?? $this->item->firstname ?? 'Cher membre',
                'type' => $this->memberType
            ]);
    }

}
