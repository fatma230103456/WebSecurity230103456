<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TemporaryPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tempPassword;

    public function __construct($tempPassword)
    {
        $this->tempPassword = $tempPassword;
    }

    public function build()
    {
        return $this->subject('Your Temporary Password')
                    ->view('emails.temporary_password')
                    ->with([
                        'tempPassword' => $this->tempPassword
                    ]);
    }
} 