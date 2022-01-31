<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class forgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {        
    
         return $this->from('demo@vlabnigeria.org', 'VLab Nigeria')
            ->subject('Reset Password')
            ->markdown('emails.forgot_password')
            ->with([                
                'url' => config('app.url', '#').'/reset_password/'.session('forgot_password_token'),
            ]);
    }
}
