<?php

namespace App\Mail;

use App\Models\Partner;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PartnerRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Partner $partner;
    public ?string $reason;

    public function __construct(Partner $partner, $reason = null)
    {
        $this->partner = $partner;
        $this->reason = $reason;
    }

    public function build()
    {
        return $this->subject('Décision concernant votre demande de partenariat')
            ->markdown('emails.partners.rejected');
    }
}
