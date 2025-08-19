<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData;

    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject($this->emailData['subject'] ?? 'Mensaje importante')
                    ->view('emails.custom')
                    ->with([
                        'content' => $this->emailData['message'],
                        'sender' => $this->emailData['email']
                    ]);
    }
}