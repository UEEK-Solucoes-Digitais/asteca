<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\ContactInfo;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $contact_info = ContactInfo::find(1);

        return $this->view('emails.contact_email')
            ->to($contact_info->email)
            ->subject("Nova mensagem de contato - " . config('app.name'))
            ->with([
                'user' => $this->user,
            ]);
    }
}
