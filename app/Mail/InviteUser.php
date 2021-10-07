<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $activationUrl, User $user)
    {
        $this->token         = $token;
        $this->activationUrl = $activationUrl;
        $this->user          = $user;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): InviteUser
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
            ->subject('Einladung zum Evaluation Tool')
            ->with([
                "activationUrl" => $this->activationUrl,
                "token"         => $this->token->token,
                "user"          => $this->user,
            ])
            ->view('mail.invite_user');
    }
}
