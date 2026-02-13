<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdhesionRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $item;
    public $name;

    public function __construct($item)
    {
        $this->item = $item;

        // Détection du nom selon le type
        $this->name = $item->name
                    ?? $item->company_name
                    ?? 'Membre';
    }

    public function build()
    {
        return $this->subject("Votre adhésion — Club DSI Bénin")
                    ->view('emails.adhesion-rejected')
                    ->with([
                        'item' => $this->item,
                        'name' => $this->name,
                    ]);
    }
}
